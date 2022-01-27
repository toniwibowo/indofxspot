const App = () => {
    return(
        <section className="page-content">
            <div className="container-fluid">
                <div className="row">
                    <div className="col">
                        <h2 className="py-3">Rebates</h2>
                    </div>
                </div>

                <div className="page-cont-inner">
                    <div className="rebate-overview mb-3">
                        <div className="row">
                            <div className="col-12 col-md-auto">
                                <div className="rebate-overview--box">
                                    <i className="fas fa-fw fa-3x fa-dollar-sign"></i>
                                    <b>$ 0</b><br />
                                    Total broker rebate earnings
                                </div>
                            </div>
                            <div className="col-12 col-md-auto">
                                <div className="rebate-overview--box">
                                    <i className="fas fa-fw fa-3x fa-file-invoice-dollar"></i>
                                    <b>0</b><br />
                                    Total broker account registered
                                </div>
                            </div>
                            <div className="col-12 col-md-auto">
                                <div className="rebate-overview--box">
                                    <i className="fas fa-fw fa-3x fa-hand-holding-usd"></i>
                                    <b>$ 0</b><br />
                                    Total earnings pay out
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <DataTable />
            </div>
        </section>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)