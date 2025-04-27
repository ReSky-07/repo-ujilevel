import "../style/LandingPage.css";
import sendlogo from "../assets/sendlogo.png";
import sendbutton from "../assets/sendbutton.png";
import location from "../assets/location.png";
import email from "../assets/email.png";
import whatsapp from "../assets/whatsapp.png";
import { useState } from "react";
import axios from "axios";

const Contact = () => {
    const [form, setForm] = useState({
        name: "",
        email: "",
        pesan: "",
    });

    const handleChange = (e) => {
        setForm({ ...form, [e.target.id]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.post("/contacts", form, {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            });
            alert("Pesan berhasil dikirim!");
            setForm({ name: "", email: "", pesan: "" });
        } catch (error) {
            console.error(error);
            alert("Terjadi kesalahan saat mengirim pesan.");
        }
    };

    return (
        <div className="contact" id="contact">
            <div>
                <div className="contact-content">
                    <div className="contact-text">
                        Contact
                        <img
                            className="imgsendlogo"
                            src={sendlogo}
                            alt="Send Logo"
                        />
                    </div>

                    <form className="contact-form" onSubmit={handleSubmit}>
                        <div className="form-responsive">
                            <input
                                type="text"
                                className="form-control"
                                id="name"
                                placeholder="Masukkan nama..."
                                value={form.name}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="form-responsive">
                            <input
                                type="text"
                                className="form-control"
                                id="email"
                                placeholder="Masukkan email..."
                                value={form.email}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="form-responsive">
                            <input
                                type="text"
                                className="form-control"
                                id="pesan"
                                placeholder="Masukkan pesan..."
                                value={form.pesan}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="div-button-contact">
                            <button type="submit" className="button-contact">
                                <img
                                    className="img-button-contact"
                                    src={sendbutton}
                                    alt="Kirim"
                                />
                            </button>
                        </div>
                    </form>
                </div>

                <div className="fading-line"></div>

                <div className="card-contact">
                    <div className="card-content-contact">
                        <h5 className="mb-3 mt-3">
                            <img
                                className="location-logo"
                                src={location}
                                alt="Location"
                            />
                        </h5>
                        <h6 className="card-title mb-3">Lokasi</h6>
                        <div className="red-line mb-3">
                            <div className="redline"></div>
                        </div>
                        <p className="card-subtitle text-muted">
                            JL. Raya Ciherang, Ciherang, Kec, Dramaga, Kab
                            Bogor, Jawa Barat 16680
                        </p>
                    </div>
                    <div className="card-content-contact">
                        <h5 className="mb-3 mt-4">
                            <img
                                className="email-logo"
                                src={email}
                                alt="Email"
                            />
                        </h5>
                        <h6 className="card-title mb-3">Email</h6>
                        <div className="red-line mb-3">
                            <div className="redline"></div>
                        </div>
                        <p className="card-subtitle text-muted">
                            mrmuhammadrizky477@gmail.com
                        </p>
                    </div>
                    <div className="card-content-contact">
                        <h5 className="mb-3 mt-3">
                            <img
                                className="whatsapp-logo"
                                src={whatsapp}
                                alt="Whatsapp"
                            />
                        </h5>
                        <h6 className="card-title mb-3">Whatsapp</h6>
                        <div className="red-line mb-3">
                            <div className="redline"></div>
                        </div>
                        <p className="card-subtitle text-muted">
                            +62 878-4771-2715
                        </p>
                    </div>
                </div>

                <div className="copyright mt-4">
                    Copyright @Laila Fried Chicken 2024
                </div>
            </div>
        </div>
    );
};

export default Contact;
