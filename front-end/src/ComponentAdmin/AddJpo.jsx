import React from 'react'
import axios from 'axios';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { useState } from 'react';



export default function AddJpo() {
   const [formulaire, setFormulaire] = useState({
    name: '', heureDebut: '', heureFin: '', date: '', image: '', description: ''
  });

  // 1. handleChange
  const handleChange = (e) => {
    if (e.target.type === 'file') {
      setFormulaire({ ...formulaire, [e.target.name]: e.target.files[0] });
    } else {
      setFormulaire({ ...formulaire, [e.target.name]: e.target.value });
    }
  };

  // 2. handleSubmit
  const handleSubmit = async (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('name', formulaire.name);
    formData.append('description', formulaire.description);
    formData.append('heureDebut', formulaire.heureDebut);
    formData.append('heureFin', formulaire.heureFin);
    formData.append('date', formulaire.date);
    formData.append('image', formulaire.image);
    try {
      const response = await axios.post(
        'http://localhost/JPO-Connect/back-end/src/traitement.php',
        formData
      );
      console.log('Response data:', response.data);
    } catch (error) {
      console.error('Error posting data:', error);
    }
  };
      // console.log('Données :', formulaire);

  return (
    <>
    <div className='container'>

        <h1>Ajouter une Journée de porte ouvert</h1>
      <Form onSubmit={handleSubmit}>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
          <Form.Label>Nom</Form.Label>
          <Form.Control 
          name='name'
          type="text" 
          placeholder="Le nom du JPO"
          defaultValue={formulaire.name}
          onChange={handleChange}  />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput2">
          <Form.Label>HeureDebut	</Form.Label>
          <Form.Control
          name='heureDebut' 
          type="time" 
          placeholder="L'heure de Debut"
          defaultValue={formulaire.heureDebut}
          onChange={handleChange}  />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput3">
          <Form.Label>HeureFin	</Form.Label>
          <Form.Control 
          name='heureFin'
          type="time" 
          placeholder="L'heure de Fin"
          defaultValue={formulaire.heureFin}
          onChange={handleChange}  />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput4">
          <Form.Label>Date </Form.Label>
          <Form.Control
          name='date' 
          type="date" 
          placeholder="La date du JPO "
          defaultValue={formulaire.date}
          onChange={handleChange} />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea5">
          <Form.Label>Description </Form.Label>
          <Form.Control as="textarea" rows={3}
          name='description'  
          placeholder="La descritption du JPO "
          defaultValue={formulaire.description}
          onChange={handleChange} />
        </Form.Group>
        <Form.Group className="mb-3" controlId="exampleForm.ControlInput6">
          <Form.Label>image</Form.Label>
          <Form.Control 
          type="file"
          name='image'  
          defaultValue={formulaire.image} 
          onChange={handleChange} />
        </Form.Group>
        <Button type="submit">Submit form</Button>
      </Form>
          </div>
    </>
  )
}
