import '@testing-library/jest-dom';
import { render, screen } from '@testing-library/react';
import App from './App';

test('renders URL input', () => {
  render(<App />);
  const input = screen.getByPlaceholderText(/Entrez votre URL/i);
  expect(input).toBeInTheDocument();
});
