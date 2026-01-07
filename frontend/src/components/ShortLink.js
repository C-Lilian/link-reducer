export default function ShortLink({ link }) {
  const handleCopy = () => {
    navigator.clipboard.writeText(link);
    alert('Lien copié !');
  };
  
  return (
    <div className="short-link">
      <a href={link} target="_blank" rel="noopener noreferrer">{link}</a>
      <button onClick={handleCopy}>Copier</button>
    </div>
  );
}
