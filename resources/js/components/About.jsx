import "../style/LandingPage.css";
import ayam1 from "../assets/ayam1.png";
import ayam2 from "../assets/ayam2.png";

const About = () => {
  return (
    <div>
      <div className="about" id="about">
        <div className="titleAbout">
          <div> Why do we use it?</div>
        </div>
        <div className="descAbout">
          <div>Lorem Ipsum es simplemente el texto de relleno</div>
          <div>de las imprentas y archivos de texto. Lorem</div>
          <div>Ipsum ha sido el texto de relleno estándar de</div>
          <div>las industrias.</div>
        </div>
      </div>

      <div className="card">
        <div className="card1">
          <img src={ayam1} alt="ayam1" className="ayam1" />
        </div>
        <div className="card2">
          <div className="card-content">
            <div className="card2-title">Lorem Ipsum</div>
            <div className="card4-desc">
              <div>
              Lorem Ipsum is simply dummy text
              </div>
              <div>
              of the printing and typesetting
              </div>
              <div>
              industry. Lorem Ipsum has been
              </div>
              <div>
              the industry's standard dummy
              </div>
              <div>
              text ever since the 1500s
              </div>
            </div>
          </div>
        </div>
        <div className="card4">
          <div className="card-content">
            <div className="card4-title">Lorem Ipsum</div>
            <div className="card4-desc">
              <div>
              Lorem Ipsum is simply dummy text
              </div>
              <div>
              of the printing and typesetting
              </div>
              <div>
              industry. Lorem Ipsum has been
              </div>
              <div>
              the industry's standard dummy
              </div>
              <div>
              text ever since the 1500s
              </div>
            </div>
          </div>
        </div>
        <div className="card3">
          <img src={ayam2} alt="ayam2" className="ayam2" />
        </div>
      </div>
    </div>
  );
};

export default About;
