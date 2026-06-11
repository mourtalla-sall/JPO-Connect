import { Routes, Route, Link } from 'react-router-dom'
import Connexion from './component/Connexion'
import Inscription from './component/Inscription'


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
        <Link to="/Inscription">Inscription</Link>


      </nav>

      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/connexion" element={<Connexion />} />
        <Route path="/Inscription" element={<Inscription />} />

      </Routes>
    </>
  )
}