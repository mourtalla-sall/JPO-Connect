import axios from 'axios';
import React from 'react'
import { useState, useEffect} from 'react';
import { Link } from 'react-router-dom';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';



export default function ReadJpo() {
  const [data , setData] = useState([])

 const HandleData = async () => {
  try {
    const response = await axios.get('http://localhost/JPO-Connect/back-end/src/traitement.php');
    console.log(response.data); 
    setData(response.data);   
  } catch (error) {
    console.error('Error fetching users:', error);
  }};
  useEffect(() => {
    HandleData();
  }, []);
  return (
    <>
    <div className='container'>
      <h1 className='mt-5'>ReadJpo</h1> 
      <Table striped bordered hover>
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date</th>
            <th>Heure Debut</th>
            <th>Heure fin</th>
            <th>Action</th>
            
          </tr>
        </thead>
       <tbody>
        {data.map((jpo) => (
            <tr key={jpo.id}> 
            <td>{jpo.id}</td>
            <td><img src={`/images/${jpo.image}`} alt={jpo.name} width={50} /></td> 
            <td>{jpo.name}</td>
            <td>{jpo.description}</td>
            <td>{jpo.date}</td>
            <td>{jpo.heureDebut}</td>
            <td>{jpo.heureFin}</td>
            <td>
              <div className='d-fex justify-content-center gap-2'>
                <Button className='btn btn-warning btn-sm'>
                  <Link to={`/UpdateJpo/${jpo.id}`} className='btn btn-warning btn-sm'>Modifier</Link>
                </Button>
                <Button className='btn btn-danger btn-sm'>Supprimer</Button>
              </div>
            </td>
          </tr>
        ))}
</tbody>
    </Table>
    </div>
    </>
  )
}
