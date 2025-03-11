import axios from "axios";
import React, { useEffect, useState } from "react";
import { Button, Card, CardImg, Spinner } from "react-bootstrap";

const MonPremierComposant = (props) => {
    //etat de l'animation du chargement des donnees
    const [loading,setLoading] = useState(true);
    const [users, setUsers] = useState([]);

    //on va appeler cette api pour récupérer un tableau d'utilisateurs 
    useEffect( () => {
        axios.get("https://reqres.in/api/users?per_page=20").then((response)=>{
            setUsers(response.data.data);
            // console.log(response.data.data);
            setLoading(false);
        }).catch(thrown => {});

    }, []);

    return (
        <div className={"container"}>
            {
                users ? (
                    <>
                        <div className="row">
                            <div className={'col-12 mt-4'}>
                                <h1 className={'p-3 text-center'} style={{color: "#4169E1", fontSize: "2.8em"}}>Notre équipe</h1>
                                <hr />
                            </div>
                        </div>
                        <div className="row">

                            {
                                users && users.map((item, index)=> (
                                    <div className="col-md-4 p-2" key={index}>
                                        <Card style={{ width: '18rem' }}>
                                            <Card.Img variant="top" src={item.avatar} />
                                            <Card.Body>
                                                <Card.Title>{item.first_name} {item.last_name}</Card.Title>
                                                <Card.Text>
                                                    {item.email}
                                                </Card.Text>
                                            </Card.Body>
                                        </Card>
                                    </div>)
                                )}

                        </div>
                    </>
                ) : (
                    <Spinner animation="grow" variant="info" />
                )
            }

        </div>
    );

}

export default MonPremierComposant