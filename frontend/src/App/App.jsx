import './App.css';
import { BrowserRouter, Routes, Route } from "react-router";
import Home from "../Home";

function App() {
  return (
      <BrowserRouter>
        <div className="App">
            <h1>11112</h1>
            <Routes>
                <Route exact path="/" element={<Home name="Иван" />} />
            </Routes>
        </div>
      </BrowserRouter>

  );
}
export default App;
