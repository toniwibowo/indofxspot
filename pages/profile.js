const App = () => {
    const{useEffect, useState} = React

    const[dataUser, setDataUser] = useState({})
    const[reload, setReload] = useState(false)

    useEffect(() => {
        getUser()
    }, [reload])

    const getUser = async () => {
        const user = await fetch(`${app.baseUrl}api/users/user?id=${app.sessionHooks['custId']}`)
        const response = await user.json()

        if (user.status === 200) {
            if (response.status === 'Success') {
                //console.log('DATA USER', response.data, response.loginAttempts);
                setDataUser({...dataUser, data: response.data, attempts: response.loginAttempts})
            }
        }
    }

    const inputHandler = (e) => {
        const name = e.target.name;
        const value = e.target.value;

        // console.log('NAME', name);
        // console.log('VALUE', value);

        setDataUser({...dataUser, data: { ...dataUser['data'], [name]: value  } })
    }

    const avatarHandler = async (e) => {
        
        const name = e.target.name;
        let value = e.target.value;
        const File = e.target.files[0];

        const data = new FormData();

        data.append('customer_id', app.sessionHooks['custId'])
        data.append('dt_avatar', File)

        console.log('DATA FILES', data.getAll('dt_avatar'), File);

        const updateAvatar = await fetch(`${app.baseUrl}api/users/updateProfile`, {
            method:'POST',
            body: data
        })

        if (updateAvatar.status === 200) {
            
            const response = await updateAvatar.json()

            console.log('RESPONSE FILE', response);

            if (response.status === 'Success') {
                Swal.fire('Success', 'Your avatar has been updated', 'success')
                .then(btnYes => {
                    console.log('BTN YES', btnYes);
                    if (btnYes.isConfirmed) {
                        setReload(c => !c)
                    }
                })
            }else{
                Swal.fire('Failed', 'Your avatar has not been updated', 'error')
            }
        }


    }

    const submitHandler = async (e) => {
        
        e.preventDefault()

        //console.log('ONSUBMIT', dataUser['data']);

        const updateProfile = await fetch(`${app.baseUrl}api/users/updateProfile`, {
            headers:{
                'Content-Type' :'application/json'
            },
            method:'POST',
            body: JSON.stringify(dataUser['data'])
        })

        if (updateProfile.status === 200) {
            
            const response = await updateProfile.json()

            if (response.status === 'Success') {
                Swal.fire('Success', 'Your profile has been updated', 'success')
            }else{
                Swal.fire('Failed', 'Your profile has not been updated', 'error')
            }
        }
    }

    const passwordHandler = async (e) => {

        e.preventDefault()

        const updatePassword = await fetch(`${app.baseUrl}api/users/updatePassword`, {
            headers:{
                'Content-Type' :'application/json'
            },
            method:'POST',
            body: JSON.stringify(dataUser['data'])
        })

        if (updatePassword.status === 200) {
            
            const response = await updatePassword.json()

            if (response.status === 'Success') {
                Swal.fire('Success', 'Your password has been updated', 'success')
            }else{
                Swal.fire('Failed', 'Your password has not been updated', 'error')
            }
        }

    }

    useEffect(() => {
        console.log('CEK', dataUser);
    }, [dataUser])

    return(
        <section className="page-content">
            <div className="container-fluid">
                <div className="row">
                    <div className="col">
                        <h2 className="py-3">Update Profile</h2>
                    </div>
                </div>

                <div className="page-cont-inner">

                <div className="row">
                    <div className="col-md-6">
                        <div className="block grey p-3 mb-5">
                            <div className="row d-flex align-items-center">
                                <div className="col-md-6">
                                    <form action="" encType='multipart/form-data'>
                                        <div className="avloader">
                                            <div id="avatar" className="shadow">
                                                {
                                                    Object.keys(dataUser).length > 0 && (
                                                        dataUser.data.dt_avatar !== '' ?
                                                        <img src={app.baseUrl + 'assets/images/' + dataUser.data['dt_avatar']} className="img-fluid" />
                                                        :
                                                        null
                                                    )
                                                }
                                            </div>
                                        </div>
                                        <div className="my-3 text-center">
                                            <a href="#!" className="btn btn-sm btn-primary upload-avatar">
                                                Edit Profile Picture
                                                <input type="file" name="dt_avatar" id="dt_picture" className="btn btn-sm btn-primary" data-preview="avatar" accept="image/png, image/jpeg" onChange={avatarHandler} />
                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div className="col-md-6 text-center">
                                    {
                                        Object.keys(dataUser).length > 0 && (
                                            <>
                                                <h5><b>{dataUser.data['dt_fname']}</b></h5>
                                                <ul className="text-center no-style">
                                                    <li>User ID : #{dataUser.data['dt_username']}</li>
                                                    <li>Join : {dataUser.data['dt_joinDate']}</li>
                                                    <li>Last Login : {dataUser.attempts['login_date']}</li>
                                                    <li>IP Address : {dataUser.attempts['ip_address']}</li>
                                                </ul>
                                            </>
                                        )
                                    }
                                    
                                </div>
                            </div>
                        </div>

                        <form action="" className="py-3" onSubmit={submitHandler}>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_fname">First Name</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_fname" id="dt_fname" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_fname'] : ''} readOnly="readonly" />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_lname">Last Name</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_lname" id="dt_lname" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_lname'] : ''} readOnly="readonly" />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_uname">Username</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_uname" id="dt_uname" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_username'] : ''} readOnly="readonly" />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_email">Email</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="email" className="form-control" name="dt_email" id="dt_email" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_email'] : ''} readOnly="readonly" />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_mobile">Mobile</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_phone" id="dt_mobile" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_phone'] : ''} onChange={inputHandler} />
                                </div>
                            </div>
                            {/* <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_phone">Phone</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_phone" id="dt_phone" defaultValue="" />
                                </div>
                            </div> */}
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_country">Country</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_country" id="dt_country" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_country'] : ''} onChange={inputHandler} />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_city">City</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="text" className="form-control" name="dt_city" id="dt_city" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_city'] : ''} onChange={inputHandler} />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_address">Address</label>
                                </div>
                                <div className="col-md-7">
                                    <textarea className="form-control" name="dt_address" id="dt_address" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_address'] : ''} onChange={inputHandler} >

                                    </textarea>
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_dob">Date of Birth</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="date" className="form-control" name="dt_dob" id="dt_dob" defaultValue={Object.keys(dataUser).length > 0 ? dataUser.data['dt_dob'] : ''} onChange={inputHandler} />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="offset-md-3 col-md-7 d-grid">
                                    <button type="submit" className="btn btn-md btn-primary">Save</button>
                                </div>
                            </div>
                        </form>

                        <div className="row">
                            <div className="col">
                                <h2 className="py-3">Change Password</h2>
                            </div>
                        </div>

                        <form action="" className="py-3" onSubmit={passwordHandler}>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="col-md-3">
                                    <label htmlFor="dt_password">New Password</label>
                                </div>
                                <div className="col-md-7">
                                    <input type="password" className="form-control" name="dt_password" id="dt_pass" defaultValue="" onChange={inputHandler} />
                                </div>
                            </div>
                            <div className="row d-flex align-items-center mb-3">
                                <div className="offset-md-3 col-md-7 d-grid">
                                    <button type="submit" className="btn btn-md btn-primary">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                </div>
            </div>
        </section>
    )
}

const root = document.getElementById('root')
ReactDOM.render(<App />, root)