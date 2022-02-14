const App = () => {
    const{useEffect, useState} = React

    const[fieldsBroker, setFieldsBroker] = useState({dt_broker:'', dt_accName:'', dt_accNumber:'', account_type_id:null, dt_comment:''});
    const[dataBroker, setDataBroker] = useState([]);
    const[dataAccountType, setAccountType] = useState([]);
    const[reload, setReload] = useState(false);

    const getBrokerData = async () => {
        const getBroker = await fetch(`${app.baseUrl}api/broker/getBroker`)
        if (getBroker.status === 200) {
            const response = await getBroker.json()

            if (response.status === 'Success') {
                setDataBroker(response.data)
            }
        }
    }

    const getAccountType = async () => {
        const query = await fetch(`${app.baseUrl}api/broker/getAccountType`)
        if (query.status === 200) {
            const response = await query.json()

            if (response.status === 'Success') {
                setAccountType(response.data)
            }
        }
    }

    useEffect(() => {
        getBrokerData()
        getAccountType()
    }, [reload])

    const inputHandler = (e) => {
        const name = e.target.name;
        const value = e.target.value;

        setFieldsBroker({...fieldsBroker, [name]: value})
    }

    const submitHandler = async (e) => {
        
        e.preventDefault()

        const paramToArray = Object.entries(fieldsBroker)
        const checkEmptyField = paramToArray.filter(([key, value]) => value === '' && key !== 'dt_comment')

        if (checkEmptyField.length > 0) {
            Swal.fire('Warning!', 'Please fill the required fields', 'warning')
        }else{
            const submitBroker = await fetch(`${app.baseUrl}api/broker/submit`,{
                headers:{
                    'Content-Type' : 'application/json'
                },
                method:'POST',
                body: JSON.stringify(fieldsBroker)
            })
            
            if (submitBroker.status === 200) {
                
                const response = await submitBroker.json()

                console.log('RESPONSE SUBMIT', response);

                if (response.status === 'Success') {
                    Swal.fire('Success', 'Sumbit broker already successfully', 'success')
                    .then(btnYes => {
                        if (btnYes.isConfirmed) {
                            setReload(c => !c)
                            $('#formBroker')[0].reset()
                        }
                    })
                }else{
                    Swal.fire('Failed', response.message, 'error')
                }
            }
        }
    }

    const deleteBrokerHandler = (id) => {
        console.log('just Chcek', id);
        const deleteBorker = async () => {
            const delBro = await fetch(`${app.baseUrl}api/broker/delAccBroker`, {
                method:'POST',
                headers:{
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({'broker_id' : id})
            })

            const response = await delBro.json()

            if (delBro.status === 200) {
                console.log('response', response);
                if (response.status === 'Success') {
                    Swal.fire('Success',response.message,'success')
                    .then(btnYes => {
                        if (btnYes.isConfirmed) {
                            setReload(c => !c)
                        }
                    })
                }else{
                    Swal.fire('Failed', response.message, 'error')
                }
            }
        }

        Swal.fire({
            'title':'Confirm',
            'text':'Are you sure want to delete this item ?',
            'icon':'question',
            'confirmButtonText':'Yes',
            'showCancelButton': true,
            'cancelButtonText':'No',
            'cancelButtonColor':'red',
            'reverseButtons': true
        })
        .then(btnYes => {
            if (btnYes.isConfirmed) {
                deleteBorker()    
            }
        })
    }

    useEffect(() => {
        console.log('DATA FIELDS', fieldsBroker);
    }, [fieldsBroker])

    return(
        <section className="page-content">
            <div className="container-fluid">
                <div className="row">
                    <div className="col">
                        <h2 className="py-3">My Trading Account</h2>
                    </div>
                </div>

                <div className="page-cont-inner">
                    <div className="row">
                        <TableBroker data={dataBroker} del={(id) => deleteBrokerHandler(id)} />
                        <FormBroker accType={dataAccountType} change={inputHandler} submit={submitHandler} />
                    </div>
                </div>
            </div>
        </section>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)