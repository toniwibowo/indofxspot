const App = () => {
    const {useEffect, useState, useCallback, useRef} = React

    const[regParam, setRegParam] = useState({dt_fname:'', dt_lname:'', dt_password: '', dt_email:'' })
    const[depositParam, setDepositParam] = useState({dt_fullname:'', dt_email:'', dt_noWallet:'', dt_bank: '', dt_noRekening:'', dt_depositIdr: 0, dt_depositIdrFormat: 0, dt_depositUsd: 0 })
    const[withdrawParam, setWithdrawParam] = useState({dt_withdrawal: 0, dt_noWallet: '', dt_namaKtp: '', dt_email:'', dt_bank: '', dt_noRekening: '', dt_captcha:''})
    const[captcha, setCaptcha] = useState('');
    const[dataKurs, setDataKurs] = useState({})
    
    const getKurs = async () => {
        const getDataKurs = await fetch(`${app.baseUrl}api/users/kurs`)
        const response = await getDataKurs.json()

        if (getDataKurs.status === 200) {
            if (response.status === 'Success') {
                setDataKurs(response['data'])
            }
        }
    }

    useEffect(() => {

        getKurs()

        $("a.hash").click(function (e) {
            e.preventDefault();
            var dis = $(this);
            var disTarget = dis.data('target');
            $("a.hash").removeClass('active');
            dis.addClass('active');
            $(".hidden-cont .animate__animated").removeClass('animate__fadeIn').hide();
            $("#" + disTarget).show().addClass('animate__fadeIn');
        });

        $('.revealer').click(function (e) {
            var $pwd = $('.pwd');
            var $eye = $(this).find('i.fas');
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
                $eye.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                $pwd.attr('type', 'password');
                $eye.removeClass('fa-eye').addClass('fa-eye-slash');
            }
            e.preventDefault();
        });

        const captchaRandom = Math.floor(Math.random() * 100000)

        setCaptcha(captchaRandom)

    }, [])

    const inputHandler = useCallback((e) => {
        const name = e.target.name
        const value = e.target.value

        setRegParam({...regParam, [name]: value})
        
    }, [regParam])

    const onSubmitHandler = (e) => {
        
        e.preventDefault()

        const paramToArray = Object.entries(regParam)
        const checkEmptyField = paramToArray.filter(([key, value]) => value === '')

        if (checkEmptyField.length > 0) {
            Swal.fire('info', 'Please fill the required fields', 'warning')
        }
        else if (!validateEmail(regParam['dt_email'])) {
            Swal.fire('info', 'Please fill with the valid email', 'warning')
        }else if(regParam['dt_password'] !== regParam['dt_confirmPassword']){
            Swal.fire('info', 'Oups! your password doesn\'t match', 'warning')
        } else{

            console.log('key', app.config.passKey);

            const regParamUpdate = {...regParam}
            const password = CryptoJS.HmacSHA1(regParam['dt_password'], app.config.passKey).toString()
            console.log('pass', password);
            // regParamUpdate['dt_password'] = password;

            (async () => {
                const postReg = await fetch(`${app.baseUrl}api/users/register`, {
                    headers:{
                        'Content-Type': 'application/json'
                    },
                    method:'POST',
                    body: JSON.stringify(regParamUpdate)
                })

                const response = await postReg.json()

                if (postReg.status === 200) {
                    if (response.status === 'Success') {
                        Swal.fire('Success', 'Registration has been successful', 'success')
                        .then(btnYes => {
                            if (btnYes.isConfirmed) {
                                $('#register form')[0].reset()
                            }
                        })
                    }else{
                        Swal.fire(response['status'], response['message'], 'error')
                    }
                }else{
                    Swal.fire(response['status'], response['message'], 'error')
                }

                console.log(postReg);
                console.log(response);
            })()
        }

        
    }

    const depositInputHandler = useCallback((e) => {
        
        const name = e.target.name
        const value = e.target.value

        let kursDeposit = 0

        if (name === 'dt_depositIdr') {

            if (Object.keys(dataKurs).length > 0) {
                kursDeposit = dataKurs['kurs_deposit']
            }

            const idr = parseInt(value)
            const usd = idr / kursDeposit;
            const usdFormat = isNaN(usd) ? 0 : usd

            let idrFormat = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value)

            console.log('USD FORMAT', usdFormat);

            setDepositParam({...depositParam, [name]: value, 'dt_depositIdrFormat' : idrFormat , 'dt_depositUsd' : numberFormat(usdFormat)})

            return false
            
        }

        setDepositParam({...depositParam, [name]: value})
        
    }, [depositParam])

    const onDepositSubmitHandler = (e) => {

        e.preventDefault()

        const paramToArray = Object.entries(depositParam)
        const checkEmptyField = paramToArray.filter(([key, value]) => value === '')

        if (checkEmptyField.length > 0) {
            Swal.fire('info', 'Please fill the required fields', 'warning')
        }else{
            (async () => {

                const postDeposit = await fetch(`${app.baseUrl}api/users/deposit`, {
                    headers:{
                        'Content-Type' : 'application/json'
                    },
                    method:'POST',
                    body: JSON.stringify(depositParam)
                })
                const response = await postDeposit.json()

                if (postDeposit.status === 200) {
                    if (response.status === 'Success') {
                        Swal.fire('Success', 'Thanks for your deposit, please check your email', 'success')
                        .then(btnYes => {
                            if (btnYes.isConfirmed) {
                                $('#userDeposit')[0].reset()
                            }
                        })
                    }else{
                        Swal.fire(response['status'], response['message'], 'error')
                    }
                }else{
                    Swal.fire(postDeposit['status'].toString(), postDeposit['statusText'], 'error')
                }

                console.log('post deposit', postDeposit);

            })()
        }
    }

    const withdrawInputHandler = useCallback((e) => {

        const name = e.target.name
        const value = e.target.value

        setWithdrawParam({...withdrawParam, [name]: value})

    }, [withdrawParam])

    const onWithdrawSubmitHandler = (e) => {
        e.preventDefault()

        const paramToArray = Object.entries(withdrawParam)
        const checkEmptyField = paramToArray.filter(([key, value]) => value === '')

        if (checkEmptyField.length > 0) {
            Swal.fire('info', 'Please fill the required fields', 'warning')
        }else if (!validateEmail(withdrawParam['dt_email'])) {
            Swal.fire('info', 'Please fill with the valid email', 'warning')
        }else if(parseInt(captcha) !== parseInt(withdrawParam['dt_captcha'])){
            Swal.fire('info', 'Captcha does not match', 'warning')
        }else{
            (async () => {

                const withdrawPost = await fetch(`${app.baseUrl}api/users/withdraw`, {
                    headers:{
                        'Content-Type' : 'application/json'
                    },
                    method:'POST',
                    body: JSON.stringify(withdrawParam)
                })
                const response = await withdrawPost.json()

                if (withdrawPost.status === 200) {
                    if (response.status === 'Success') {
                        Swal.fire('Success', 'Thanks for your deposit', 'success')
                        .then(btnYes => {
                            if (btnYes.isConfirmed) {
                                $('#userwithdrawal')[0].reset()
                            }
                        })
                    }else{
                        Swal.fire(response['status'], response['message'], 'error')
                    }
                }else{
                    Swal.fire(withdrawPost['status'].toString(), withdrawPost['statusText'], 'error')
                }

                console.log('post deposit', withdrawPost);

                const captchaRandom = Math.floor(Math.random() * 100000)

                setCaptcha(captchaRandom)

            })()
        }
    }

    useEffect(() => {
        console.log(withdrawParam);
    }, [withdrawParam])

    return(
        <>
            <Menu data={dataKurs} />
            <div className="hidden-cont">
                <JamLayanan />
                <Registration change={(e) => inputHandler(e)} submit={(e) => onSubmitHandler(e)} />
                <Deposit data={depositParam} change={(e) => depositInputHandler(e)} onSubmit={(e) => onDepositSubmitHandler(e)} />
                <Withdrawal change={(e) => withdrawInputHandler(e)} onSubmit={(e) => onWithdrawSubmitHandler(e)} captcha={captcha} captchaReloader={(e) => setCaptcha(e)} />
                <Login />
            </div>
            
        </>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)