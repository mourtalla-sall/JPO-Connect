import { Routes, Route, Link } from 'react-router-dom'
import Connexion from './component1/Connexion'


function Home() {
  return <h1>Accueil</h1>
}

function About() {
  return <h1>À propos</h1>
}

export default function App() {
  return (
    <>
      <nav>
        <Link to="/">Accueil</Link> |{" "}
        <Link to="/about">À propos</Link>
        <Link to="/connexion">Connexion</Link>
        <label for="site-search">Rechercher sur le site&nbsp;:</label>
<input type="search" id="site-search" name="q" />

<button>Rechercher</button>
        
      </nav>

      <Routes> 
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/connexion" element={<Connexion />} />

        {/* {user.role === admin &&  
         // <Route path="/admin" element={<Admin />} />
        } */}
      </Routes>
    </>
  )
}