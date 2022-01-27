const DataTable = () => {
    const {useEffect, useState, useCallback} = React

    const [dataTableRebate, setDataTableRebate] = useState([])
    const [dataFilterRebate, setFilterRebate] = useState({dt_datestart:'', dt_dateend:''})
    const [rebateCount, setRebateCount] = useState({})

    const inputHandler = (e) => {
        const name = e.target.name;
        const value = e.target.value;

        setFilterRebate({...dataFilterRebate, [name]: value})
    }

    useEffect(() => {
        console.log(dataFilterRebate);
    }, [dataFilterRebate])

    const filterHandler = () => {
        if (dataFilterRebate['dt_datestart'] !== '' && dataFilterRebate['dt_dateend'] !== '') {
            dataFilter(dataFilterRebate['dt_datestart'], dataFilterRebate['dt_dateend'])    
        }else{
            Swal.fire('Ops!', 'Please fill required fields','warning')
        }
    }

    const dataFilter = async (startDate, endDate) => {
        const filterRebates = await fetch(`${app.baseUrl}api/rebates/getRebatesByDate?startDate=${startDate}&endDate=${endDate}`)
        const response = await filterRebates.json()
        if (filterRebates.status === 200) {
            if (response.status === 'Success') {
                console.log('RESPONSE FILTER', response);
                setDataTableRebate(response.data)
            }
        }
    }

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
        
        dataWallet()
        rebateCounting()

    }, [])

    useEffect(() => {

        $('#tableRebate').DataTable().destroy();

        $('#tableRebate').DataTable({
            data: dataTableRebate,
            columnDefs:[
                {
                    targets:3,
                    className:'text-center'
                },
                {
                    targets:4,
                    className:'text-center'
                }
            ],
            columns:[
                {
                    data: 'date_order'
                },
                {
                    data: 'account_number'
                },
                {
                    data: 'dt_broker'
                },
                {
                    data: function(row, type, set){
                        // console.log(row, type, set);
                        let mount = 0;
                        if (Object.keys(rebateCount).length > 0) {
                            if (row['category'] === 'Classic') {
                                mount = row['amount'] * rebateCount['rbt_classic']    
                            }else{
                                mount = row['amount'] * rebateCount['rbt_pro'] 
                            }
                            
                        }
                        return mount;
                    }
                },
                {
                    data: function(row, type, set){
                        // console.log(row, type, set);
                        return `<i class="fas fa-fw fa-check"></i>`;
                    }
                }
            ],
            orderable: !1,
            shorting:[]
        })

        console.log('DATA TABLE', dataTableRebate);
    }, [dataTableRebate, rebateCount])

    const dataWallet = async () => {
        const getRebates = await fetch(`${app.baseUrl}api/rebates/getDataRebates`)
        const response = await getRebates.json()
        if (getRebates.status === 200) {
            if (response.status === 'Success') {
                console.log('RESPONSE', response);
                setDataTableRebate(response.data)
            }
        }
    }

    return(
        <div className="block grey shadow-sm p-2 mb-3">
                <div className="block m-0 p-3">
                    <div className="rebate-history">
                        <h5 className="d-block mb-3"><b>Rebate History</b></h5>
                        <form action="#!" className="row g-2">
                            {/* <div className="col-6 col-md-auto">
                                <div className="form-floating">
                                    <select type="text" name="dt_custom" id="dt_custom" className="form-control" placeholder="Custom">
                                        <option value="Custom 1">Custom 1</option>
                                        <option value="Custom 2">Custom 2</option>
                                    </select>
                                    <label for="dt_custom">Custom</label>
                                </div>
                            </div> */}
                            <div className="col-6 col-md-auto">
                                <div className="form-floating">
                                    <input type="date" name="dt_datestart" id="dt_datestart" className="form-control datepicker" placeholder="Date start" onChange={inputHandler} />
                                    <label htmlFor="dt_datestart">Start</label>
                                </div>
                            </div>
                            <div className="col-6 col-md-auto">
                                <div className="form-floating">
                                    <input type="date" name="dt_dateend" id="dt_dateend" className="form-control datepicker" placeholder="Date end" onChange={inputHandler} />
                                    <label for="dt_dateend">End</label>
                                </div>
                            </div>
                            {/* <div className="col-6 col-md-auto">
                                <div className="form-floating">
                                    <select type="text" name="dt_status" id="dt_status" className="form-control" placeholder="Status">
                                        <option value="Any status">Any status</option>
                                        <option value="Status 1">Status 1</option>
                                        <option value="Status 2">Status 2</option>
                                    </select>
                                    <label for="dt_status">Custom</label>
                                </div>
                            </div> */}
                            <div className="col-12 col-md-auto d-grid">
                                <button type="button" className="btn btn-md btn-primary" onClick={() => filterHandler()}>Filter</button>
                            </div>
                        </form>
                        <div className="table-responsive my-3">
                        
                            <table id="tableRebate" className="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">DATE ORDER CLOSED</th>
                                        <th scope="col">ACCOUNT NUMBER</th>
                                        <th scope="col">BROKER</th>
                                        <th scope="col">AMOUNT</th>
                                        <th scope="col" className="text-center">STATUS</th>
                                        {/* <th scope="col" className="text-center">DETAILS</th> */}
                                    </tr>
                                </thead>                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    )
}