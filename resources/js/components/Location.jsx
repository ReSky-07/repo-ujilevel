import "../style/LandingPage.css";
import lokasi1 from "../assets/lokasi1.png";
import lokasi2 from "../assets/lokasi2.png";
import lokasi3 from "../assets/lokasi3.png";
import star from "../assets/star.png";

const Location = () => {
  return (
    <div className="location" id="location">
      <div className="location-content">
        <div className="title-location">Lokasi</div>
        <div className="cardlocation">
          <div className="card1loc">
            <img src={lokasi1} alt="lokasi1" className="lokasi1" />
            <div className="overlay">
              <h3>Lokasi 1</h3>
              <p>
                Jl. Raya Ciherang, Ciherang, Kec. Dramaga, Kab Bogor, Jawa Barat
                16680
              </p>
            </div>
          </div>

          <div className="card2loc">
            <img src={lokasi2} alt="lokasi2" className="lokasi2" />
            <div className="overlay">
              <h3>Lokasi 2</h3>
              <p>
              JL. Tegal Loceng No.3, rt.03/04.Margajaya, Kec, Bogor Bar., Kota bogor, Jawa Barat
              </p>
            </div>
          </div>

          <div className="card3loc">
            <img src={lokasi3} alt="lokasi3" className="lokasi3" />
            <div className="overlay">
              <h3>Lokasi 3</h3>
              <p>
              Dramaga, Kec. Dramaga, Kab Bogor, Jawa Barat 16680
              </p>
            </div>
          </div>
        </div>
      </div>
      <div className="footer-decoration">
        <div className="footer-line-with-stars">
          <div className="footer-line"></div>
          <div className="footer-stars">
            <img src={star} alt="star" />
          </div>
          <div className="footer-line"></div>
        </div>
      </div>
    </div>
  );
};

export default Location;
