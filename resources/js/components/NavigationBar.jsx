import React, { useState, useEffect } from "react";
import { Navbar, Container, Nav, NavbarBrand } from "react-bootstrap";
import { Link } from "react-router-dom";
import axios from "axios";
import logolfc from "../assets/logolfc.png";
import "../style/LandingPage.css";

const NavigationBar = () => {
    const [activeLink, setActiveLink] = useState("home");
    const [scrollY, setScrollY] = useState(0);
    const [authStatus, setAuthStatus] = useState({
        isAuthenticated: false,
        loginUrl: "/login",
        registerUrl: "/register",
        dashboardUrl: "/dashboard",
    });

    useEffect(() => {
        axios.get("/api/auth-status")
            .then((response) => setAuthStatus(response.data))
            .catch((error) => console.error("Error fetching auth status", error));
    }, []);

    useEffect(() => {
        const handleScroll = () => {
            setScrollY(window.scrollY);

            const sections = ["home", "about", "location", "contact"];
            for (let section of sections) {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top >= -50 && rect.top < 150) {
                        setActiveLink(section);
                        break;
                    }
                }
            }
        };

        window.addEventListener("scroll", handleScroll);
        return () => window.removeEventListener("scroll", handleScroll);
    }, []);

    const handleLinkClick = (link) => {
        setActiveLink(link);
        const element = document.getElementById(link);
        if (element) {
            const navbarHeight = document.querySelector(".navbar").offsetHeight;
            const offsetTop = element.offsetTop - navbarHeight;
            window.scrollTo({ top: offsetTop, behavior: "smooth" });
        }
    };

    const opacity = Math.min(1, scrollY / 300);

    return (
        <Navbar expand="lg" className={`navbar fixed-top ${scrollY > 50 ? "navbar-scrolled" : ""}`}
            style={{ backgroundColor: `rgba(255, 0, 0, ${opacity})` }}>
            <Container>
                <NavbarBrand>
                    <a href="#home" onClick={() => handleLinkClick("home")}>
                        <img src={logolfc} alt="LFC Logo" className="logo" />
                    </a>
                </NavbarBrand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="mx-auto navlinks center-nav">
                        <Nav.Link onClick={() => handleLinkClick("home")}
                            className={activeLink === "home" ? "active-link" : ""}>
                            Home
                        </Nav.Link>
                        <Nav.Link onClick={() => handleLinkClick("about")}
                            className={activeLink === "about" ? "active-link" : ""}>
                            About
                        </Nav.Link>
                        <Nav.Link onClick={() => handleLinkClick("location")}
                            className={activeLink === "location" ? "active-link" : ""}>
                            Location
                        </Nav.Link>
                        <Nav.Link onClick={() => handleLinkClick("contact")}
                            className={activeLink === "contact" ? "active-link" : ""}>
                            Contact
                        </Nav.Link>
                    </Nav>
                    <div className="auth-buttons">
                        {authStatus.isAuthenticated ? (
                            <Nav.Link href={authStatus.dashboardUrl} className="auth-link">
                                Dashboard
                            </Nav.Link>
                        ) : (
                            <>
                                <Nav.Link href={authStatus.loginUrl} className="auth-link">
                                    Login
                                </Nav.Link>
                                {authStatus.registerUrl && (
                                    <Nav.Link href={authStatus.registerUrl} className="auth-link">
                                        Register
                                    </Nav.Link>
                                )}
                            </>
                        )}
                    </div>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default NavigationBar;
