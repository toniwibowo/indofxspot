const TableBroker = ({data, del}) => {
    const delHandler = (id) => {
        return del(id)
    }
    return(
        <div className="col-md-8">

            <div className="block shadow mb-3 py-2">
                <div className="inner">
                    <div className="row">
                        <div className="col-12">
                            <div className="table-responsive">
                                <table className="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">DATE ADDED</th>
                                            <th scope="col">ACCOUNT NUMBER</th>
                                            <th scope="col">ACCOUNT HOLDER NAME</th>
                                            <th scope="col">BROKER</th>
                                            <th scope="col">TYPE</th>
                                            <th scope="col" className="text-center">STATUS</th>
                                            <th scope="col" className="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {
                                            data.length > 0 && (
                                                data.map((item, idx) => {
                                                    return(
                                                        <tr key={idx}>
                                                            <td>{item.dt_createDate}</td>
                                                            <td>{item.dt_accNumber}</td>
                                                            <td>{item.dt_accName}</td>
                                                            <td>{item.dt_broker}</td>
                                                            <td>{item.name_account_type}</td>
                                                            <td>{item.dt_status}</td>
                                                            <td><button className="btn btn-sm" onClick={() => delHandler(item['broker_id'])}><i className="fa fa-trash"></i></button></td>
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

        </div>
    )
}

const FormBroker = ({accType, change, submit}) => {
    return(
        <div className="col-md-4">
            <div className="block shadow grey">
                <div className="inner p-3">

                    <h4 className="d-block text-center my-4">Add a Broker Account</h4>
                    
                    <form id="formBroker" action="" onSubmit={submit}>
                        <div className="d-block mb-3">
                            <div className="d-block position-relative ps-4 ms-2 mb-2">
                                <span className="dotnum">1</span> 
                                Select Broker
                            </div>
                            <select className="form-control form-select" defaultValue="" name="dt_broker" id="dt_broker" required="required" onChange={change}>
                                <option value="">--Choose Broker--</option>
                                <option value="Tickmill UK">Tickmill UK</option>
                                <option value="Tickmill Seychelles">Tickmill Seychelles</option>
                            </select>
                        </div>
                        <div className="d-block mb-3">
                            <div className="d-block mb-3 position-relative ps-4 ms-2">
                                <span className="dotnum">2</span>
                                Open a Live Account with Broker. If you already have a live account with broker, please continue to step 3.
                            </div>
                            <div className="text-center d-grid my-3">
                                <button className="btn btn-sm btn-primary mb-2">Open a Live Trading Account with<br /><b>Tickmill UK</b></button>
                                <button className="btn btn-sm btn-primary">Open a Live Trading Account with<br /><b>Tickmill Seychelles</b></button>
                            </div>
                        </div>
                        <div className="d-block mb-3">
                            <div className="d-block mb-3 position-relative ps-4 ms-2">
                                <span className="dotnum">3</span> 
                                Provide your Live Broker Trading Account details
                            </div>
                            <div className="form-group mb-3">
                                <label htmlFor="dt_accName">Account Name</label>
                                <input className="form-control" defaultValue="" name="dt_accName" id="dt_name" required="required" onChange={change} />
                            </div>
                            <div className="form-group mb-3">
                                <label htmlFor="dt_accNumber">Account mt4 Number</label>
                                <input className="form-control" defaultValue="" name="dt_accNumber" id="dt_accnumber" required="required" onChange={change} />
                            </div>
                            <div className="form-group mb-3">
                                <label htmlFor="dt_accType">Account Type</label>
                                <select className="form-select" defaultValue="" name="account_type_id" id="dt_acctype" required="required" onChange={change}>
                                    <option value="">--Select One--</option>
                                    {
                                        accType.length > 0 ?
                                        accType.map((row, i) => {
                                            return <option key={i} value={row['account_type_id']}>{row['name_account_type']}</option>
                                        })
                                        :
                                        null
                                    }
                                </select>
                            </div>
                            <div className="form-group mb-3">
                                <label htmlFor="dt_comment">Comment</label>
                                <textarea className="form-control" defaultValue="" name="dt_comment" id="dt_comment"></textarea>
                            </div>
                            <div className="d-grid">
                                <button type="submit" className="btn btn-md btn-primary ">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    )
}