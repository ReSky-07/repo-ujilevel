import "../style/LandingPage.css";
import ayam1 from "../assets/ayam1.png";
import ayam2 from "../assets/ayam2.png";

const About = () => {
    return (
        <div>
            <div className="about" id="about">
                <div className="titleAbout">
                    <div>About Us</div>
                </div>
                <div className="descAbout">
                    <div>Laila Fried Chicken adalah tempat terbaik </div>
                    <div>
                        untuk menikmati ayam goreng renyah dengan cita rasa khas
                    </div>
                    <div>
                        Berdiri dengan semangat menyajikan makanan berkualitas,
                    </div>
                    <div>
                        kami menggunakan bahan-bahan pilihan dan resep rahasia
                        keluarga yang terus dijaga keasliannya.
                    </div>
                </div>
            </div>

            <div className="card">
                <div className="card1">
                    <img src={ayam1} alt="ayam1" className="ayam1" />
                </div>
                <div className="card2">
                    <div className="card-content">
                        <div className="card4-desc">
                            <div>Laila Fried Chicken hadir</div>
                            <div>membawa kelezatan ayam goreng</div>
                            <div>yang gurih, renyah, dan juicy</div>
                            <div>di setiap gigitan</div>
                           
                        </div>
                    </div>
                </div>
                <div className="card4">
                    <div className="card-content">
                        <div className="card4-desc">
                            <div>Kami percaya bahwa </div>
                            <div>makanan enak adalah </div>
                            <div> bagian dari kebahagiaan.</div>

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
