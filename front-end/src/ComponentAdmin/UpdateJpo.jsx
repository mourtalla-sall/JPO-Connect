import React from 'react'
import axios from 'axios';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { Link } from 'react-router-dom';



export default function UpdateJpo() {
    const [formulaire, setFormulaire] = useState({
    name: '', heureDebut: '', heureFin: '', date: '', image: '', description: '' });
    const { id } = useParams(); // récupère l'id depuis l'URL

    // handleChange
    const handleChange = (e) => {
        if (e.target.type === 'file') {
        setFormulaire({ ...formulaire, [e.target.name]: e.target.files[0] });
        } else {
        setFormulaire({ ...formulaire, [e.target.name]: e.target.value });
        }
    };

    //  ajouter : charge les données existantes
    useEffect(() => {
        axios.get(`http://localhost/JPO-Connect/back-end/src/traitement.php?id=${id}`)
        .then(response => {
            setFormulaire(response.data);
        })
        .catch(error => console.error(error));
    }, [id]);
  
  // handleSubmit
    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', formulaire.name);
        formData.append('description', formulaire.description);
        formData.append('heureDebut', formulaire.heureDebut);
        formData.append('heureFin', formulaire.heureFin);
        formData.append('date', formulaire.date);
        if (formulaire.image instanceof File) {
            formData.append('image', formulaire.image); 
        }
        try {
        const response = await axios.put(
            'http://localhost/JPO-Connect/back-end/src/traitement.php',
            formData
        );
        console.log('Response data:', response.data);
        } catch (error) {
        console.error('Error posting data:', error);
        }};

    return (
    <>
    <div className='container'>

        <h1>Modifier une Journée de porte ouvert</h1>
        <Form onSubmit={handleSubmit}>
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
            <Form.Label>Nom</Form.Label>
            <Form.Control 
            name='name'
            type="text" 
            placeholder="Le nom du JPO"
            value={formulaire.name || ''}
            onChange={handleChange}  />
            </Form.Group>
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput2">
            <Form.Label>HeureDebut	</Form.Label>
            <Form.Control
            name='heureDebut' 
            type="time" 
            placeholder="L'heure de Debut"
            value={formulaire.heureDebut || ''}
            onChange={handleChange}  />
            </Form.Group>
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput3">
            <Form.Label>HeureFin	</Form.Label>
            <Form.Control 
            name='heureFin'
            type="time" 
            placeholder="L'heure de Fin"
            value={formulaire.heureFin || ''}
            onChange={handleChange}  />
            </Form.Group>
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput4">
            <Form.Label>Date </Form.Label>
            <Form.Control
            name='date' 
            type="date" 
            placeholder="La date du JPO "
            value={formulaire.date || ''}
            onChange={handleChange} />
            </Form.Group>
            <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea5">
            <Form.Label>Description </Form.Label>
            <Form.Control as="textarea" rows={3}
            name='description'  
            placeholder="La descritption du JPO "
            value={formulaire.description || ''}
            onChange={handleChange} />
            </Form.Group>
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput6">
            <Form.Label>image</Form.Label>
            {formulaire.image && !formulaire.image instanceof File && (
                <img src={`/images/${formulaire.image}`} width={100} alt="actuelle" />
                )}
            <Form.Control type="file" name='image' onChange={handleChange} />
            </Form.Group>
            <Button type="submit">Update form</Button>
            <Button className='btn btn-danger text-white'><Link to="/ReadJpo">Annuler</Link></Button>
        </Form>
          </div>
    </>
  )
}
