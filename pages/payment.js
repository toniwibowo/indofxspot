const App = () => {
    const{useEffect, useState} = React

    const[dataPayment, setDataPayment] = useState([])
    const[listPayment, setListPayment] = useState([])
    const[paramPayment, setParamPayment] = useState({payment_id:0, bank_name:'', holder_name:'', bank_account:''})
    const[notes, setNotes] = useState({})
    const[reload, setReload] = useState(false)

    const[modalHandler, setModalHandler] = useState(null)

    const getDataPayment = async () => {
        const getPayment = await fetch(`${app.baseUrl}api/payment/paymentMethod`)
        if (getPayment.status === 200) {
            const response = await getPayment.json()
            if (response.status === 'Success') {
                setDataPayment(response.data)
            }
        }
    }

    useEffect(() => {
        getDataPayment()
        getListDataPayment()
        getPaymentNotes()

    }, [reload])

    console.log('modal', modalHandler);

    const getPaymentNotes = async () => {
        const dataPaymentNotes = await fetch(`${app.baseUrl}api/payment/getPaymentNotes`)
        const response = await dataPaymentNotes.json()
        if (dataPaymentNotes.status === 200) {
            if (response.status === 'Success') {
                setNotes(response['data'])
            }
        }
    }

    const getPID = (val) => {
        setParamPayment({...paramPayment, payment_id: val})
    }

    const modalBootstrap = (act, id) => {

        const modalPaymentID = document.getElementById('modalPaymentMethod');
        const paymentModal = new bootstrap.Modal(modalPaymentID)

        if (act === 'show') {
            paymentModal.show()
        }else{
            paymentModal.hide()
        }
        
    }

    const paymentInputHandler = (e) => {
        const name = e.target.name
        const value = e.target.value
        setParamPayment({...paramPayment, [name]: value})
    }

    const paymentSubmitHandler = async () => {

        const submitPaymentMethod = await fetch(`${app.baseUrl}api/payment/addListPayment`,{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body: JSON.stringify(paramPayment)
        })

        const response = await submitPaymentMethod.json()

        if (submitPaymentMethod.status === 200) {
            
            if (response.status === 'Success') {
                Swal.fire('Success', response.message, 'success')
                .then(btnYes => {
                    if (btnYes.isConfirmed) {

                        modalBootstrap('hide','modalPaymentMethod')

                        setReload(c => !c)
                    }
                })
            }else{
                Swal.fire('Faied', response.message, 'error')
            }

        }else{
            Swal.fire('Faied', response.message, 'error')
        }
    }

    const getListDataPayment = async () => {
        const getListPayment = await fetch(`${app.baseUrl}api/payment/getListPayment?id=${app.sessionHooks['custId']}`)
        const response = await getListPayment.json()

        console.log('RESPONSE LIST', response);

        if (getListPayment.status === 200) {
            
            if (response.status === 'Success') {
                setListPayment(response['data'])
            }
        }
    }

    useEffect(() => {
        console.log('LISTNYA', listPayment);
    }, [listPayment])

    useEffect(() => {
        console.log('PARAM', paramPayment);
    }, [paramPayment])

    return(
        <>

            <ModalPaymentMethod change={(e) => paymentInputHandler(e)} submit={() => paymentSubmitHandler()} />
            <section className="page-content">
                <div className="container-fluid">
                    <div className="row">
                        <div className="col">
                            <h2 className="py-3">Payment Method</h2>
                        </div>
                    </div>

                    <div className="page-cont-inner">
                        <div className="mb-4">
                            <div className="row d-flex align-items-center">
                                <div className="col-md-auto mb-2">
                                    <h5 className="mb-0"><b>Available Payment Method</b></h5>
                                </div>
                                <div className="col-md-auto mb-2">
                                    <a href="#!" className="btn btn-md btn-primary">Withdrawal Request</a>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <h5 className="my-4"><b>Available Payment Method</b></h5>

                        <div className="table-responsive">
                            <table className="table align-middle table-striped text-center">
                                <thead className="table-dark">
                                    <tr>
                                        <th scope="col"><b>Name</b></th>
                                        <th scope="col"><b>Minimum</b></th>
                                        <th scope="col"><b>Maximum</b></th>
                                        <th scope="col"><b>Provider Fee</b></th>
                                        <th scope="col"><b>Options</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        dataPayment.length > 0 && (
                                            dataPayment.map((row, idx) => {
                                                return(
                                                    <tr key={idx}>
                                                        <td>{row['name']}</td>
                                                        <td>{row['minimum']}</td>
                                                        <td>{row['maximum']}</td>
                                                        <td>{row['provider_fee']}</td>
                                                        <td><button className="btn btn-primary btn-sm" onClick={() => {getPID(row['payment_id']); modalBootstrap('show', 'modalPaymentMethod');}}>Add Bank Account</button></td>
                                                    </tr>
                                                )
                                            })
                                        )
                                    }
                                </tbody>
                            </table>
                        </div>

                        <div className="my-4">
                            <b>Note:</b>
                            <div dangerouslySetInnerHTML={{__html: notes['description_en']}}></div>
                        </div>

                        <hr />

                        <div className="my-4">
                            <div className="row d-flex align-items-center">
                                <div className="col-md-auto mb-2">
                                    <h5 className="mb-0"><b>Your Payment System</b></h5>
                                </div>
                            </div>
                        </div>

                        <div className="block p-3">
                            <div className="table-responsive">
                                <table className="table align-middle table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>No</b></th>
                                            <th scope="col"><b>Bank Name</b></th>
                                            <th scope="col"><b>Account Holder Name</b></th>
                                            <th scope="col"><b>Account Number</b></th>
                                            <th scope="col"><b>Status</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {
                                            listPayment.length > 0 && (
                                                listPayment.map((item, no) => {
                                                    return(

                                                        item.length > 0 ?
                                                        item.map((row,idx) => {
                                                            idx++
                                                            return(
                                                                <tr key={idx}>
                                                                    <td>{idx}</td>
                                                                    <td>{row['bank_name']}</td>
                                                                    <td>{row['holder_name']}</td>
                                                                    <td>{row['bank_account']}</td>
                                                                    <td>{row['status']}</td>
                                                                </tr>
                                                            )
                                                        })
                                                        :
                                                        null

                                                    )
                                                    
                                                })
                                            )    
                                        }
                                    </tbody>
                                </table>
                            </div>    
                        </div>

                    </div>
                </div>
            </section>
        </>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)