import "../style/LandingPage.css";
import sendlogo from "../assets/sendlogo.png";
import sendbutton from "../assets/sendbutton.png";
import location from "../assets/location.png";
import email from "../assets/email.png";
import whatsapp from "../assets/whatsapp.png";

const Contact = () => {
  return (
    <div className="contact" id="contact">
      <div>
        <div className="contact-content">
          <div className="contact-text">
            Contact
            <img className="imgsendlogo" src={sendlogo} />
          </div>
          <form className="contact-form">
            <div className="form-responsive">
              <input
                type="text"
                className="form-control"
                id="name"
                placeholder="Masukkan nama..."
              />
            </div>
            <div className="form-responsive">
              <input
                type="text"
                className="form-control"
                id="email"
                placeholder="Masukkan email..."
              />
            </div>
            <div className="form-responsive">
              <input
                type="text"
                className="form-control"
                id="pesan"
                placeholder="Masukkan pesan..."
              />
            </div>
          </form>
          <div className="div-button-contact">
            <button className="button-contact">
              <img className="img-button-contact" src={sendbutton} />
            </button>
          </div>
        </div>
        <div className="fading-line"></div>
        <div className="card-contact">
          <div className="card-content-contact">
            <h5 className="mb-3 mt-3"><img className="location-logo" src={location}/></h5>
            <h6 className="card-title mb-3">Lokasi</h6>
            <div className="red-line mb-3">
              <div className="redline"></div>
            </div>
            <p className="card-subtitle text-muted">
            JL. Raya Ciherang, Ciherang, Kec, Dramaga, Kab Bogor, jawa Barat 16680
            </p>
          </div>
          <div className="card-content-contact">
            <h5 className="mb-3 mt-4"><img className="email-logo" src={email}/></h5>
            <h6 className="card-title mb-3">Email</h6>
            <div className="red-line mb-3">
              <div className="redline"></div>
            </div>
            <p className="card-subtitle text-muted">
            mrmuhammadrizky477@gmail.com
            </p>
          </div>
          <div className="card-content-contact">
            <h5 className="mb-3 mt-3"><img className="whatsapp-logo" src={whatsapp}/></h5>
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
