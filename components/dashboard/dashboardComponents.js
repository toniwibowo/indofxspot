const{useEffect, useState} = React

onload = function(){ 
    var ele = document.querySelectorAll('.number-only')[0];
    ele.onkeypress = function(e) {
        if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
            return false;
    }
    ele.onpaste = function(e){
       e.preventDefault();
    }
}

const ModalWithdrawal = ({change, submit}) => {

    const[dataPaymentList,setDataPaymentList] = useState([])

    const getPaymentList = async () => {
        const queryPaymentMethod = await fetch(`${app.baseUrl}api/payment/getListPayment?id=${app.sessionHooks['custId']}`)
        const response = await queryPaymentMethod.json()
        
        if (queryPaymentMethod.status === 200) {
            console.log('response list', response);
            if (response.status === 'Success') {
                setDataPaymentList([response.data])
            }
        }
    }

    useEffect(() => {
        getPaymentList()
    }, [])

    console.log('list', dataPaymentList);

    return(
        <div id="modalWithdrawal" className="modal fade" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div className="modal-content">
                <div className="modal-header">
                    <h5 className="modal-title" id="exampleModalLabel">Order Withdrawal</h5>
                    <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div className="modal-body">
                    <form>
                        <div className="row">
                            <div className="col-lg-6 mb-4">
                                <label htmlFor="paymentMethod" className="col-form-label">Payment</label>
                                <select className="form-select" id="paymentMethod" name="cst_wdw_paylist" defaultValue="" onChange={change}>
                                    <option value="">--Select One--</option>
                                    {
                                        dataPaymentList.length > 0 && (
                                            dataPaymentList.map((item, i) => {
                                                console.log('item', item);
                                                return item.map((row, idx) => {
                                                        console.log('row', row);
                                                        return row.map((rw, ix) => {
                                                            return <option key={ix} value={`${rw.payment_id},${rw.payList_id}`}>{`${rw.bank_name} - ${rw.bank_account}`}</option>
                                                        })
                                                    }
                                                )
                                            })
                                        )
                                    }
                                </select>
                            </div>
                            <div className="col-lg-6 mb-4">
                                <label htmlFor="paymentMethod" className="col-form-label">Amount</label>
                                <input className="form-control number-only" name="cst_wdw_amount" onChange={change} />
                            </div>
                            <div className="col-lg-12">
                                <label htmlFor="wdlDescription" className="col-form-label">Description</label>
                                <textarea id="wdlDescription" className="form-control" name="cst_wdw_desc" onChange={change}></textarea>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div className="modal-footer">
                    <button type="button" className="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" className="btn btn-primary" onClick={submit}>Order</button>
                </div>
                </div>
            </div>
        </div>
    )
}

const MainMenu = ({dataBroker, actionModal, rebate}) => {

    console.log('RBT', rebate, Object.keys('rebate').length);

    return(
        <>
            <div className="main-menu">
                <div className="row mb-2">
                    <div className="col-md-6">
                        <div className="block shadow blue">
                            <div className="inner">
                                <div className="row">
                                    <div className="col-3 d-flex align-items-center">
                                        <i className="fas fa-fw fa-hand-holding-usd fa-2x"></i>
                                    </div>
                                    <div className="col-9">
                                        <div className="block-cont">
                                            <span className="d-block mb-1">Total Rebate Earning</span>
                                            <h2 className="mb-0">${rebate.rbt_balance}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="block shadow red">
                            <div className="inner">
                                <div className="row">
                                    <div className="col-3 d-flex align-items-center">
                                        <i className="fas fa-fw fa-handshake fa-2x"></i>
                                    </div>
                                    <div className="col-9">
                                        <div className="block-cont">
                                            <span className="d-block mb-1">Total Broker Account Registered</span>
                                            <h2 className="mb-0">{dataBroker.length}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="block shadow green">
                <div className="inner">
                    <div className="row">
                        <div className="col-md-6 col-4 d-flex align-items-center justify-content-center">
                            <div className="block-cont">
                                <img src={`${app.baseUrl}assets/images/icon-withdrawal.png`} alt="" className="icon img-fluid" />
                            </div>
                        </div>
                        <div className="col-md-6 col-8">
                            <div className="block-cont">
                                <span className="d-block mb-1">Total Withdrawal Anda</span>
                                <h2 className="py-1">${rebate.rbt_payout}</h2>
                                <button className="btn btn-sm btn-success" onClick={actionModal}>ORDER WITHDRAWAL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

const RebateTablePayout = ({data}) => {
    console.log('DATA REBATES PAYOUT', data);

    return(
        <div className="block shadow mb-3">
            <div className="inner">
                <div className="row">
                    <div className="col-12">
                        <div className="table-responsive">
                            <span className="d-block my-3">Last 5 Rebate Payout</span>
                            <table id="rebatesTable" className="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">CREATION DATE</th>
                                        <th scope="col">PAYMENT SYSTEM</th>
                                        <th scope="col">BANK NAME</th>
                                        <th scope="col">BANK ACCOUNT</th>
                                        <th scope="col">VOLUME</th>
                                        <th scope="col" className="text-center">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        data.length > 0 && (
                                            data.map((item,idx) => {
                                                return(
                                                    <tr key={idx}>
                                                        <td>{item['cst_wdw_date']}</td>
                                                        <td>{item['name']}</td>
                                                        <td>{item['bank_name']}</td>
                                                        <td>{item['bank_account']}</td>
                                                        <td>${item['cst_wdw_amount']}</td>
                                                        <td align="center"><i className="fas fa-fw fa-check"></i> {item['cst_wdw_status']}</td>
                                                    </tr>
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
        </div>
    )
}

const RebateTable = ({data}) => {
    //console.log('DATA REBATES', data);

    const [rebateCount, setRebateCount] = useState({})

    const rebateCounting = async () => {
        const counterRebates = await fetch(`${app.baseUrl}api/rebates/getRebatesCounting`)
        const response = await counterRebates.json()
        if (counterRebates.status === 200) {
            if (response.status === 'Success') {
                console.log('RESPONSE COUNTER', response);
                setRebateCount(response.data)
            }
        }
    }

    useEffect(() => {

        rebateCounting()

    }, [])

    return(
        <div className="block shadow mb-3">
            <div className="inner">
                <div className="row">
                    <div className="col-12">
                        <div className="table-responsive">
                            <span className="d-block my-3">Last 5 Rebate History</span>
                            <table id="rebatesTable" className="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">DATE ORDER CLOSED</th>
                                        <th scope="col">ACCOUNT NUMBER</th>
                                        <th scope="col">BROKER</th>
                                        <th scope="col">VOLUME</th>
                                        <th scope="col">TYPE</th>
                                        <th scope="col" className="text-center">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        data.length > 0 && (
                                            data.map((item,idx) => {
                                                
                                                return(
                                                    <tr key={idx}>
                                                        <td>{item['date_order']}</td>
                                                        <td>{item['account_number']}</td>
                                                        <td>{item['dt_broker']}</td>
                                                        <td>{item['amount'] * parseFloat(item['acc_amount'])}</td>
                                                        <td align="center">{item['category']}</td>
                                                        <td align="center"><i className="fas fa-fw fa-check"></i></td>
                                                    </tr>
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
        </div>
    )
}

const RightBar = ({data}) => {

    // console.log('DATA USER INSIDE', data);

    return(
        <div className="col-md-4">
            <div className="block shadow grey">
                <div className="inner p-3">

                {Object.keys(data).length > 0 && (<img src={`${app.baseUrl}assets/images/${Object.keys(data).length > 0 && (data.data['dt_avatar'])}`} className="img-fluid profile-pic" />)}
                    
                    <ul className="text-center no-style">
                        {
                            Object.keys(data).length > 0 && (
                                <>
                                <li><b>User ID</b> : #{data.data['dt_username']}</li>
                                <li><b>Join</b> : {data.data['dt_joinDate']}</li>
                                <li><b>Last Login</b> : {data.attempts['login_date']}</li>
                                <li><b>IP Address</b> : {data.attempts['ip_address']}</li>
                                </>
                            )
                        }
                        
                    </ul>
                </div>
            </div>
        </div>    
    )
}