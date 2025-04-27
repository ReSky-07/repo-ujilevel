import React, { useState, useEffect } from "react";
import { Navbar, Container, Nav, NavbarBrand } from "react-bootstrap";
import axios from "axios";
import logolfc from "../assets/logolfc.png";
import "../style/LandingPage.css";

const NavigationBar = () => {
    const [activeLink, setActiveLink] = useState("home");
    const [scrollY, setScrollY] = useState(0);
    const [expanded, setExpanded] = useState(false);
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

    // Add this effect to handle mobile nav styling
    useEffect(() => {
        // Update CSS for navbar-collapse when expanded state changes
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse) {
            if (expanded) {
                navbarCollapse.classList.add('show-mobile-nav');
            } else {
                navbarCollapse.classList.remove('show-mobile-nav');
            }
        }
    }, [expanded]);

    const handleLinkClick = (link) => {
        setActiveLink(link);
        setExpanded(false);
        const element = document.getElementById(link);
        if (element) {
            const navbarHeight = document.querySelector(".navbar").offsetHeight;
            const offsetTop = element.offsetTop - navbarHeight;
            window.scrollTo({ top: offsetTop, behavior: "smooth" });
        }
    };

    const opacity = Math.min(1, scrollY / 300);

    return (
        <Navbar 
            expand="lg" 
            expanded={expanded}
            onToggle={(expanded) => setExpanded(expanded)}
            className={`navbar fixed-top ${scrollY > 50 ? "navbar-scrolled" : ""}`}
            style={{ backgroundColor: `rgba(255, 52, 34, ${opacity})` }}
        >
            <Container>
                <NavbarBrand>
                    <a href="#home" onClick={() => handleLinkClick("home")}>
                        <img src={logolfc} alt="LFC Logo" className="logo" />
                    </a>
                </NavbarBrand>
                <Navbar.Toggle 
                    aria-controls="basic-navbar-nav" 
                    className={`navbar-toggler custom-toggler ${expanded ? 'active' : ''}`}
                />
                <Navbar.Collapse id="basic-navbar-nav" className={`collapse ${expanded ? 'show show-mobile-nav' : ''}`}>
                    <Nav className="mx-auto navlinks center-nav">
                        <Nav.Link 
                            onClick={() => handleLinkClick("home")}
                            className={activeLink === "home" ? "nav-link active-link" : "nav-link"}
                        >
                            Home
                        </Nav.Link>
                        <Nav.Link 
                            onClick={() => handleLinkClick("about")}
                            className={activeLink === "about" ? "nav-link active-link" : "nav-link"}
                        >
                            About
                        </Nav.Link>
                        <Nav.Link 
                            onClick={() => handleLinkClick("location")}
                            className={activeLink === "location" ? "nav-link active-link" : "nav-link"}
                        >
                            Location
                        </Nav.Link>
                        <Nav.Link 
                            onClick={() => handleLinkClick("contact")}
                            className={activeLink === "contact" ? "nav-link active-link" : "nav-link"}
                        >
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
                                <Nav.Link href={authStatus.loginUrl} className="auth-link login">
                                    Login
                                </Nav.Link>
                            </>
                        )}
                    </div>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default NavigationBar;