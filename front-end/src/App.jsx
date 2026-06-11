import { Routes, Route, Link } from 'react-router-dom'
import Connexion from './component/Connexion'
import AddJpo from './ComponentAdmin/AddJpo'
import ReadJpo from './ComponentAdmin/ReadJpo'
import UpdateJpo from './ComponentAdmin/UpdateJpo'


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
        <Link to="/AddJpo">AddJpo</Link>
        <Link to="/ReadJpo">Readpo</Link>
        
      </nav>

      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/connexion" element={<Connexion />} />
        <Route path="/AddJpo" element={<AddJpo />} />
        <Route path="/ReadJpo" element={<ReadJpo />} />
        <Route path="/UpdateJpo/:id" element={<UpdateJpo />} />


      </Routes>
    </>
  )
}