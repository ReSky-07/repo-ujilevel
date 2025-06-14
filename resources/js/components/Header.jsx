import logolfc from "../assets/logolfc.png";
import "../style/LandingPage.css";

const Header = () => {
  return (
    <div className="header" id="home">
      <div className="logoSection">
        <img src={logolfc} alt="LFC" className="logoHeader"></img>
      </div>
      <div className="textHeader">
        <div className="titleHeader">LAILA FRIED CHICKEN</div>
        <div className="descHeader">Laila Fried Chicken adalah sebuah</div>
        <div className="descHeader">printing and typesetting industry</div>
      </div>
    </div>
  );
};

export default Header;
