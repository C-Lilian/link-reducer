import { useState } from 'react';
import axios from 'axios';
import ShortLink from './ShortLink';

export default function UrlForm() {
  const [url, setUrl] = useState('');
  const [shortUrl, setShortUrl] = useState('');
  const [error, setError] = useState('');
  
  // Fonction appelée lors de la soumission du formulaire
  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setShortUrl('');
    
    try {
      // Envoi d'une requête POST au backend avec l'URL saisie
      const res = await axios.post('http://localhost:8000/reduce', { url });
      setShortUrl(res.data.short_url);
    } catch (err) {
      setError(err.response?.data?.error || 'Erreur serveur');
    }
  };
  
  return (
    <div className="url-form">
      <form onSubmit={handleSubmit}>
        <input
          type="url"
          placeholder="Entrez votre URL"
          value={url}
          onChange={(e) => setUrl(e.target.value)}
          required
        />
        <button type="submit">Raccourcir</button>
      </form>
      
      {shortUrl && <ShortLink link={shortUrl} />}
      {error && <p className="error">{error}</p>}
    </div>
  );
}
