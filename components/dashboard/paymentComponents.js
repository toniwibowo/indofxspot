const ModalPaymentMethod = ({change, submit}) => {

    const{useEffect} = React
    
    return(
        <div id="modalPaymentMethod" className="modal fade" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div className="modal-content">
                <div className="modal-header">
                    <h5 className="modal-title" id="exampleModalLabel">Payment Method</h5>
                    <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div className="modal-body">
                    <form>
                        <div className="row">
                            <div className="col-lg-12 mb-4">
                                <label htmlFor="paymentMethod" className="col-form-label">Bank Name</label>
                                <input type="text" className="form-control" name="bank_name" onChange={change} />
                            </div>
                            <div className="col-lg-12 mb-4">
                                <label htmlFor="paymentMethod" className="col-form-label">Bank Account</label>
                                <input className="form-control number-only" name="bank_account" onChange={change} />
                            </div>
                            <div className="col-lg-12">
                                <label htmlFor="wdlDescription" className="col-form-label">Bank Holder Name</label>
                                <input id="wdlDescription" className="form-control" name="holder_name" onChange={change} />
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div className="modal-footer">
                    <button type="button" className="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" className="btn btn-primary" onClick={submit}>Add</button>
                </div>
                </div>
            </div>
        </div>
    )
}