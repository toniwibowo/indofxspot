const App = () => {
    const{useEffect, useState} = React

    const[dataUser, setDataUser] = useState({})
    const[dataRebates, setDataRebates] = useState([])
    const[dataRebatesPayout, setDataRebatesPayout] = useState([])
    const[dataRebateValue, setDataRebateValue] = useState({})
    const[dataBroker, setDataBroker] = useState([])

    const[paramWithdrawal, setParamWithdrawal] = useState({cst_id: app.sessionHooks['custId'], cst_wdw_paylist:'', cst_wdw_amount:null, cst_wdw_desc:''})

    useEffect(() => {
        getUser()
        getDataRibates()
        getRebateValue()
        getBrokerData()
        getRibatesPayout()
    }, [])

    const getDataRibates = async () => {
        const getRebates = await fetch(`${app.baseUrl}api/rebates/history?limit=5`)
        const response = await getRebates.json()
        if (getRebates.status === 200) {
            if (response.status === 'Success') {
                setDataRebates(response.data)
            }
        }
    }

    const getRibatesPayout = async () => {
        const getRebates = await fetch(`${app.baseUrl}api/rebates/payout`)
        const response = await getRebates.json()
        if (getRebates.status === 200) {
            if (response.status === 'Success') {
                setDataRebatesPayout(response.data)
            }
        }
    }

    const getRebateValue = async () => {
        const rebateValue = await fetch(`${app.baseUrl}api/rebates/getRebateBalance`)
        const response = await rebateValue.json()

        console.log('REBATES BALANCE', response);

        if (rebateValue.status === 200) {
            if (response.status === 'Success') {
                setDataRebateValue(response.data)
            }
        }
    }

    const getBrokerData = async () => {
        const getBroker = await fetch(`${app.baseUrl}api/broker/getBroker`)
        if (getBroker.status === 200) {
            const response = await getBroker.json()

            if (response.status === 'Success') {
                setDataBroker(response.data)
            }
        }
    }

    const getUser = async () => {
        const user = await fetch(`${app.baseUrl}api/users/user?id=${app.sessionHooks['custId']}`)
        const response = await user.json()

        if (user.status === 200) {
            if (response.status === 'Success') {
                console.log('DATA USER', response.data, response.loginAttempts);
                setDataUser({...dataUser, data: response.data, attempts: response.loginAttempts})
            }
        }
    }

    const openModalHandler = () => {
        var myModal = new bootstrap.Modal(document.getElementById('modalWithdrawal'), {
            keyboard: false
        })

        console.log('MODAL', myModal);

        myModal.show()
    }

    const withdrawalInputHandler = (e) => {
        const name = e.target.name
        const value = e.target.value 

        setParamWithdrawal({...paramWithdrawal, [name] : value})
    }

    const withdrawalSubmitHandler = async () => {
        const postWithdrawal = await fetch(`${app.baseUrl}api/rebates/withdrawal`,{
            headers:{
                'Content-Type':'application/json'
            },
            method:'POST',
            body: JSON.stringify(paramWithdrawal)
        })

        const response = await postWithdrawal.json()

        if (postWithdrawal.status === 200) {
            if (response.status === 'Success') {
                Swal.fire(response.status, response.message, 'success')
            }else{
                Swal.fire(response.status, response.message, 'error')
            }
        }else{
            Swal.fire(response.status, response.message, 'error')
        }
    }

    useEffect(() => {
        console.log('param withdrawal', paramWithdrawal);
    }, [paramWithdrawal])

    return(
        <section className="page-content">
            <div className="container-fluid">
                <div className="row">
                    <div className="col">
                        <h2 className="py-3">Dashboard</h2>
                    </div>
                </div>

                <div className="page-cont-inner">
                    <div className="row">
                        <div className="col-md-8">
                            <MainMenu dataBroker={dataBroker} actionModal={() => openModalHandler()} rebate={dataRebateValue} />
                            <ModalWithdrawal change={(e) => withdrawalInputHandler(e)} submit={() => withdrawalSubmitHandler()} />
                            <RebateTable data={dataRebates} broker={dataBroker} />
                            <RebateTablePayout data={dataRebatesPayout} />
                        </div>
                        <RightBar data={dataUser} />
                    </div>
                </div>
            </div>
        </section>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)