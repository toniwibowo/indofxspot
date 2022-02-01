const {useEffect, useState, useCallback, useRef} = React
const Menu = ({data}) => {
    
    let kursDeposit = 0;
    let kursWithdrawal = 0;

    if (Object.keys(data).length > 0) {
        kursDeposit = data['kurs_deposit']
        kursWithdrawal = data['kurs_withdrawal']
    }

    return(
        <section className="menus my-5">
            <div className="container">
                <div className="row">
                    <div className="col">
                        <div className="menus__block px-5 text-center">
                            <div className="row">
                                <div className="col-md-4">
                                    <div className="inner ">
                                        <img src={`${app.baseUrl}assets/images/tickmill.png`} alt="" />
                                        <br />
                                        <a href="#!" data-target="layanan" className="hash btn btn-md btn-primary rounded-pill my-2 grad-blue"><span>Jam Layanan</span></a>
                                    </div>
                                </div>
                                <div className="col-md-4">
                                    <div className="inner">
                                        <h3 className="text-danger">{currencyFormat(kursDeposit)}</h3>
                                        <a href="#!" data-target="deposit" className="hash btn btn-md btn-primary rounded-pill my-2 grad-purple"><span>Deposit</span></a>
                                    </div>
                                </div>
                                <div className="col-md-4">
                                    <div className="inner">
                                        <h3 className="text-success">{currencyFormat(kursWithdrawal)}</h3>
                                        <a href="#!" data-target="withdrawal" className="hash btn btn-md btn-primary rounded-pill my-2 grad-orange"><span>Withdrawal</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}

const Registration = ({change, submit}) => {
    return(
        <div id="register" className="animate__animated">
            <form method="post" className="form" onSubmit={(e) => submit(e)}>
                <div className="container">
                    <div className="row g-4 gx-3">
                        <h2 className="d-block text-center mt-3 mb-4"><b>REGISTER</b></h2>
                    </div>
                    <div className="row g-4 gx-3">
                        <div className="col-md-6">
                            <div className="row gx-2">
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="text" name="dt_fname" id="dt_fname" className="form-control" placeholder="First Name" onChange={change} required="required" />
                                        <label htmlFor="dt_fname">First Name</label>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="text" name="dt_lname" id="dt_lname" className="form-control" placeholder="Last Name" onChange={change} required="required" />
                                        <label htmlFor="dt_lname">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div className="row gx-2">
                                {/* <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="text" name="dt_username" id="dt_username" className="form-control" placeholder="Username" onChange={change} required="required" />
                                        <label htmlFor="dt_username">Username</label>
                                    </div>
                                </div> */}
                                <div className="col-md-12">
                                    <div className="form-floating mb-2">
                                        <input type="email" name="dt_email" id="dt_email" className="form-control" placeholder="Email" onChange={change} required="required" />
                                        <label htmlFor="dt_email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div className="row gx-2">
                                {/* <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="text" name="dt_phone" id="dt_phone" className="form-control" placeholder="Phone Number" onChange={change} required="required" />
                                        <label htmlFor="dt_phone">Phone Number</label>
                                    </div>
                                </div> */}
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="password" name="dt_password" id="dt_password" minLength="8" className="form-control pwd" placeholder="Password" onChange={change} required="required" />
                                        <label htmlFor="dt_password">Password</label>
                                        <span className="revealer">
                                            <i className="fas fa-fw fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>

                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="password" name="dt_confirmPassword" id="dt_confirmPassword" minLength="8" className="form-control pwd" placeholder="Confirm Password" onChange={change} required="required" />
                                        <label htmlFor="dt_password">Confirm Password</label>
                                        <span className="revealer">
                                            <i className="fas fa-fw fa-eye-slash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {/* <div className="row gx-2">
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input name="dt_country" id="dt_country" className="form-control" placeholder="Select Country" onChange={change} required="required" />
                                        <label htmlFor="dt_country">Country</label>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input name="dt_city" id="dt_city" className="form-control" placeholder="Select City" onChange={change} required="required" />
                                        <label htmlFor="dt_city">City</label>
                                    </div>
                                </div>
                            </div> */}
                        </div>
                        <div className="col-md-6">
                            <div className="form-floating mb-2">
                                <textarea name="dt_address" id="dt_address" className="form-control" placeholder="Address" onChange={change} required="required"></textarea>
                                <label htmlFor="dt_address">Address</label>
                            </div>
                            {/* <div className="row gx-2">
                                <div className="col-md-6">
                                    <div className="form-floating mb-2">
                                        <input type="date" name="dt_dob" id="dt_dob" className="form-control datepicker" placeholder="DoB" onChange={change} required="required" />
                                        <label htmlFor="dt_dob">Date of Birth</label>
                                    </div>
                                </div>
                            </div> */}
                            <div className="d-grid gap-2 mt-2">
                                <button type="submit" className="btn btn-md btn-primary mb-3">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    )
}

const Deposit = ({data, change, onBlur, onSubmit}) => {

    const [pageItem, setPageItem] = useState({})

    let idrValue = 0

    const onFocusHandler = () => {
        idrValue = data['dt_depositIdr']
        document.getElementById('dt_depositIdr').value = idrValue
    }

    const onBlurHandler = () => {
        idrValue = data['dt_depositIdrFormat']
        document.getElementById('dt_depositIdr').value = idrValue
    }

    useEffect(async() => {
        const getPageItem = await fetch(`${app.baseUrl}api/pages/item?id=1`)
        const response = await getPageItem.json()

        if (getPageItem.status === 200) {
            if (response.status === 'Success') {
                setPageItem(response['data'])
            }
        }

        console.log('response page', response);
    }, [])

    return(
        <div id="deposit" className="animate__animated">
            <div className="container">
                <div className="row g-4">
                    <div className="col-md-6">
                        <div className="inner white-block d-flex align-items-center">
                            <div className="table-responsive">
                                <h3 className="d-block text-center my-3">{pageItem['title_en']}</h3>
                                <div dangerouslySetInnerHTML={{__html: pageItem['description_en']}}></div>
                                
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="inner">
                            <form className="form" id="userDeposit" action="" method="post" onSubmit={onSubmit}>
                                <div className="form-floating mb-2">
                                    <input type="text" name="dt_fullname" id="dt_fullname" className="form-control" placeholder="Nama" onChange={change} required="required" />
                                    <label htmlFor="dt_nama">Nama</label>
                                </div>
                                <div className="form-floating mb-2">
                                    <input type="email" name="dt_email" id="dt_emailDeposit" className="form-control" placeholder="Email" onChange={change} required="required" />
                                    <label htmlFor="dt_email">Email</label>
                                </div>
                                <div className="form-floating mb-2">
                                    <input type="text" name="dt_noWallet" id="dt_wallet" className="form-control" placeholder="Nomor Wallet" onChange={change} required="required" />
                                    <label htmlFor="dt_wallet">Nomor Wallet</label>
                                </div>
                                <div className="row gx-2">
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_bank" id="dt_bank" className="form-control" placeholder="Bank" onChange={change} required="required" />
                                            <label htmlFor="dt_bank">Bank</label>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_noRekening" id="dt_norek" className="form-control" placeholder="Nomor Rekening" onChange={change} required="required" />
                                            <label htmlFor="dt_norek">Nomor Rekening</label>
                                        </div>
                                    </div>
                                </div>
                                <div className="row gx-2">
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_depositIdr" id="dt_depositIdr" className="form-control" placeholder="Jumlah Deposit IDR" onChange={change} onBlur={() => onBlurHandler()} onFocus={() => onFocusHandler()} required="required" />
                                            <label htmlFor="dt_depositIdr">Jumlah Deposit IDR</label>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_depositUsd" id="dt_depositUsd" className="form-control" placeholder="Dalam USD" onChange={change} value={data['dt_depositUsd']} disabled />
                                            <label htmlFor="dt_depositUsd">Dalam USD</label>
                                        </div>
                                    </div>
                                </div>
                                <div className="d-grid gap-3 my-3">
                                    <button type="submit" className="btn btn-md btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

const Withdrawal = ({change, onSubmit, captcha, captchaReloader}) => {

    const [pageItem, setPageItem] = useState({})

    const captchaRefresher = () => {
        const numRandom = Math.floor(Math.random() * 100000)
        captchaReloader(numRandom)
    }

    useEffect(async() => {
        const getPageItem = await fetch(`${app.baseUrl}api/pages/item?id=3`)
        const response = await getPageItem.json()

        if (getPageItem.status === 200) {
            if (response.status === 'Success') {
                setPageItem(response['data'])
            }
        }

        console.log('response page2', response);
    }, [])

    return(
        <div id="withdrawal" className="animate__animated">
            <div className="container">
                <div className="row g-4">
                    <div className="col-md-6" dangerouslySetInnerHTML={{__html: Object.keys(pageItem).length > 0 && (pageItem['description_en'])}}>
                        
                    </div>
                    <div className="col-md-6">
                        <div className="inner d-flex align-items-center">
                            <form className="form" id="userwithdrawal" action="" method="post" onSubmit={onSubmit}>
                                <div className="row gx-2">
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_withdrawal" id="dt_withdrawal" className="form-control" placeholder="Jumlah Withdrawal" onChange={change} />
                                            <label htmlFor="dt_withdrawal">Jumlah Withdrawal (USD)</label>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_noWallet" id="dt_walletWithdraw" className="form-control" placeholder="No. Wallet" onChange={change} />
                                            <label htmlFor="dt_wallet">No. Wallet</label>
                                        </div>
                                    </div>
                                </div>
                                <div className="row gx-2">
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_namaKtp" id="dt_namaKtp" className="form-control" placeholder="Nama sesuai KTP" onChange={change} />
                                            <label htmlFor="dt_namaKtp">Nama sesuai KTP</label>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                        <input type="text" name="dt_email" id="dt_emailWithdraw" className="form-control" placeholder="Email" onChange={change} />
                                        <label htmlFor="dt_email">Email</label>
                                    </div>
                                    </div>
                                </div>
                                <div className="row gx-2">
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <select type="text" name="dt_bank" id="dt_bankWithdraw" className="form-control" placeholder="Bank" defaultValue="" onChange={change}>
                                                <option value="" disabled="disabled">Pilih Bank</option>
                                                <option value="BCA">BCA</option>
                                                <option value="Mandiri">Mandiri</option>
                                                <option value="BNI">BNI</option>
                                            </select>
                                            <label htmlFor="dt_bank">Pilih Bank</label>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" name="dt_noRekening" id="dt_noRekWithdraw" className="form-control" placeholder="Nomor Rekening" onChange={change} />
                                            <label htmlFor="dt_noRek">Nomor Rekening</label>
                                        </div>
                                    </div>
                                </div>
                                <div className="row gx-2">
                                    <div className="col-md-6 d-flex align-items-center">
                                        <div className="captcha-title text-center mx-auto my-2" data-target="dt_captcha">
                                            <h2><strong>{captcha}</strong></h2>
                                            <button type="button" className="btn btn-sm btn-primary" onClick={() => captchaRefresher()}>Refresh</button>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-floating mb-2">
                                            <input type="text" id="dt_captcha" name="dt_captcha" className="form-control captcha-code" placeholder="Captcha" onChange={change} />
                                            <label htmlFor="dt_captcha">Captcha</label>
                                        </div>
                                    </div>
                                </div>
                                <div className="d-grid gap-2">
                                    <button type="submit" className="btn btn-md btn-primary mb-3">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

const JamLayanan = () => {
    const [pageItem, setPageItem] = useState({})

    useEffect(async() => {
        const getPageItem = await fetch(`${app.baseUrl}api/pages/item?id=4`)
        const response = await getPageItem.json()

        if (getPageItem.status === 200) {
            if (response.status === 'Success') {
                setPageItem(response['data'])
            }
        }

        console.log('response page2', response);
    }, [])

    return(
        <div id="layanan" className="animate__animated">
            <div className="container">
                <div className="row g-4" dangerouslySetInnerHTML={{__html: Object.keys(pageItem).length > 0 && (pageItem['description_en'])}}>
                    
                </div>
            </div>
        </div>
    )
}

const Login = () => {

    const username = useRef() 
    const password = useRef()

    const onSubmitHandler = async (e) => {
        e.preventDefault()
        console.log('ACCOUNT', username.current.value, password.current.value);

        const dataLogin = {dt_email: username.current.value, dt_password: password.current.value }

        const postLogin = await fetch(`${app.baseUrl}api/users/login`, {
            headers:{
                'Content-Type': 'application/json'
            },
            method:'POST',
            body: JSON.stringify(dataLogin)
        })

        const response = await postLogin.json()

        if (postLogin.status === 200) {
            if (response.status === 'Success') {
                
                console.log('Data', response);

                if (Object.keys(response['data']).length > 0) {

                    // const passVerify = CryptoJS.HmacSHA1(password.current.value, app.config.passKey).toString()
                    // console.log('pass verify', passVerify, response['data']['dt_password']);

                    if (response['data']['isLogedIn']) {
                        window.location.href = `${app.baseUrl}member/dashboard`
                    }else{
                        Swal.fire('Failed', 'Login is failed, please check your username or password', 'error')
                    }
                    
                }
                
                //Swal.fire('Success', 'Registration has been successful', 'success')
            }else{
                Swal.fire(response['status'], response['message'], 'error')
            }
        }else{
            Swal.fire(response['status'], response['message'], 'error')
        }
    }


    return(
        <div id="login" className="animate__animated">
            <form action="action.php" method="post" className="form" onSubmit={(e) => onSubmitHandler(e)}>
                <div className="container">
                    <div className="row g-4 gx-3">
                        <h2 className="d-block text-center mt-3 mb-4"><b>LOGIN</b></h2>
                    </div>
                    <div className="row g-4 gx-3">
                        <div className="col-md-4 offset-md-4">
                            <div className="form-floating mb-2">
                                <input ref={username} type="text" name="dt_email" id="dt_emailLogin" className="form-control" placeholder="Email" />
                                <label htmlFor="dt_emailLogin">Email</label>
                            </div>
                            <div className="form-floating mb-2">
                                <input ref={password} type="password" name="dt_password" id="dt_passwordLogin" className="form-control pwd" placeholder="Password" />
                                    <span className="revealer">
                                        <i className="fas fa-fw fa-eye-slash"></i>
                                    </span>
                                <label htmlFor="dt_password">Password</label>
                            </div>
                            <div className="d-grid gap-2 mt-3">
                                <button type="submit" className="btn btn-md btn-primary mb-3">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    )
}