import React, { useState, useEffect } from "react";
import { Navbar, Container, Nav, NavbarBrand } from "react-bootstrap";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import logolfc from "../assets/logolfc.png";
import "../style/LandingPage.css";

const NavigationBar = () => {
  const [activeLink, setActiveLink] = useState("home");
  const [scrollY, setScrollY] = useState(0);

  useEffect(() => {
    const onScroll = () => setScrollY(window.scrollY);

    window.addEventListener("scroll", onScroll);
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const handleLinkClick = (link) => {
    setActiveLink(link);
    const element = document.getElementById(link); // Dapatkan elemen berdasarkan ID
    const navbarHeight = document.querySelector(".navbar").offsetHeight;

    if (element) {
      const offsetTop = element.offsetTop - navbarHeight;
      window.scrollTo({
        top: offsetTop,
        behavior: "smooth",
      });
    }
  };

  const opacity = Math.min(1, scrollY / 300);

  return (
    <Navbar
      expand="lg"
      className={`navbar fixed-top ${scrollY > 50 ? "navbar-scrolled" : ""}`}
      style={{ backgroundColor: `rgba(255, 0, 0, ${opacity})` }}
    >
      <Container>
        <NavbarBrand>
          <a href="#home" onClick={() => handleLinkClick("home")}>
            <img src={logolfc} alt="LFC Logo" className="logo" />
          </a>
        </NavbarBrand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="mx-auto navlinks">
            <Nav.Link
              onClick={() => handleLinkClick("home")}
              className={activeLink === "home" ? "active-link" : ""}
            >
              Home
            </Nav.Link>
            <Nav.Link
              onClick={() => handleLinkClick("about")}
              className={activeLink === "about" ? "active-link" : ""}
            >
              About
            </Nav.Link>
            <Nav.Link
              onClick={() => handleLinkClick("location")}
              className={activeLink === "location" ? "active-link" : ""}
            >
              Location
            </Nav.Link>
            <Nav.Link
              onClick={() => handleLinkClick("contact")}
              className={activeLink === "contact" ? "active-link" : ""}
            >
              Contact
            </Nav.Link>
          </Nav>
          {/* Bagian Login */}
          <div className="loginbtn navlinks">
            <Nav.Link
              href="/login"
              className={activeLink === "login" ? "active-link" : ""}
              onClick={() => setActiveLink("login")}
            >
              Login
            </Nav.Link>
          </div>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default NavigationBar;
