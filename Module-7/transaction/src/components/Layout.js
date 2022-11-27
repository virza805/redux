import logoGif from "../assets/images/logo.gif";
export default function Layout({ children }) {
    return (
        <div className="App">
            <div className="header">
                <h1>Expense Tracker</h1>
            </div>
<img src={logoGif} alt="" srcset="" className="logo-gif" />
            <div className="main">
                <div className="container">{children}</div>
            </div>

            <div className="footer">&copy;2022 vir-za.com</div>
        </div>
    );
}
