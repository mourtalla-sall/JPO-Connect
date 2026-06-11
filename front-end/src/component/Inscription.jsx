import React from "react";
import "../component/auth.css" 
import { useState } from "react";
export default function Inscription() {
const [firstName, setFirstName] = useState("");
const [lastName, setLastName] = useState("");
const [email, setEmail] = useState("");
const [password, setPassword] = useState("");
async function handleSubmit(e) { e.preventDefault();

const response = await fetch("http://localhost/JPO-Connect/back-end/src/traitement.php?action=register",
    {
        method: "POST",
        headers: {"Content-Type": "application/json",
        },
        body: JSON.stringify({firstName,lastName,email,password,}),
    }
    );

    const data = await response.json();

    if (data.success) {
    alert("Inscription réussie");
    } else {
    alert(data.message);
    }
}

return (
    <>
    <h1>Inscription</h1>
    <form onSubmit={handleSubmit}>
    <input type="text"placeholder="Prénom" required value={firstName}onChange={(e) => setFirstName(e.target.value)}/>
    <input type="text" placeholder="Nom" required value={lastName} onChange={(e) => setLastName(e.target.value)}/>
    <input type="email" placeholder="Email" required value={email} onChange={(e) => setEmail(e.target.value)}/>
    <input type="password" placeholder="Mot de passe" required  value={password} onChange={(e) => setPassword(e.target.value)}/>
    <button type="submit"> S'inscrire </button>
    </form>
    </>

);
}
