const App = () => {
    const{useEffect, useState} = React

    const [dataAnnouncements, setDataAnnouncements] = useState([])

    const getDataAnnouncements = async () => {
        const query = await fetch(`${app.baseUrl}api/announcement/getData`)
        const response = await query.json()
        if (query.status === 200) {
            if (response.status === 'Success') {
                setDataAnnouncements(response['data'])
            }
        }
    }

    useEffect(() => {
        getDataAnnouncements()
    }, [])

    return(
        <section className="page-content">
            <div className="container-fluid">
                <div className="row">
                    <div className="col">
                        <h2 className="py-3">Announcement</h2>
                    </div>
                </div>

                <div className="page-cont-inner">
                    <div className="row g-2">
                        {
                            dataAnnouncements.length > 0 && (
                                dataAnnouncements.map((item,idx) => {
                                    return(
                                        <div className="col-md-4">
                                            <div className="news-item block p-3 position-relative shadow-sm">
                                                <img src={`${app.baseUrl}assets/images/${item['image']}`} className="img-fluid mb-3" />
                                                {/* <small className="badge bg-primary mb-3 shadow">{item['title']}</small> */}
                                                <a href="#!" className="news-item--title"><h4>{item['title']}</h4></a>
                                                <div dangerouslySetInnerHTML={{__html: item['resume']}}></div>
                                            </div>
                                        </div>
                                    )
                                })
                            )
                        }
                        
                    </div>
                </div>
            </div>
        </section>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)