import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router, Routes, Route, useLocation } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "./style/LandingPage.css"; // Import CSS khusus
import NavigationBar from "./components/NavigationBar";
import Header from "./components/Header";
import About from "./components/About";
import Location from "./components/Location";
import Contact from "./components/Contact";
import Login from "./components/Login";

// Komponen utama App
function App() {
    const location = useLocation(); // Mendapatkan lokasi rute saat ini

    return (
        <>
            {/* Navbar hanya muncul jika bukan di halaman /login */}
            {location.pathname !== "/login" && <NavigationBar />}

            <Routes>
                {/* Rute untuk halaman utama */}
                <Route
                    path="/"
                    element={
                        <>
                            <div className="myBg">
                                <Header />
                            </div>
                            <About />
                            <Location />
                            <Contact />
                        </>
                    }
                />
                {/* Rute untuk halaman login */}
                <Route path="/login" element={<Login />} />
            </Routes>
        </>
    );
}

// Membungkus App dengan Router
function AppWrapper() {
    return (
        <Router>
            <App />
        </Router>
    );
}

// Render React ke dalam Laravel Blade
ReactDOM.createRoot(document.getElementById("landing-page")).render(<AppWrapper />);
