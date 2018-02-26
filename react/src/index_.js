import React from 'react';
import ReactDOM from 'react-dom';
//import './index.css';
//import App from './App';
import registerServiceWorker from './registerServiceWorker';

/*
 * Formulario de registro en envios.solinte
 */
class Form extends React.Component {
  constructor(props) {
    super(props);
    this.state = 
      {
        name: '',
        phone: '',
        email: '',
        id: '',
        state: '',
        city: '',
        address: '',
        nameIsValid: false,
        emailIsValid: false,
        disabledSubmit: true
      };
    //this.blurName = this.blurName.bind(this);
  }
  
  /*
   * Funcion que maneja el blur en el campo nombre
   */
  blurName = (event) => {    
    let name = event.target.value;
    if (!name.match(/\S/)){
      document.getElementById('errorName').innerHTML = 'El campo nombre no puede quedar vacío';
      event.target.style.backgroundColor = "yellow";
      event.target.focus = true;
      this.setState({nameIsValid: false}, () => {this.verifySubmit();});    
    }else{
      document.getElementById('errorName').innerHTML = '';
      event.target.style.backgroundColor = "white";
      this.setState({nameIsValid: true}, () => {this.verifySubmit();});
    }
  }         

  /*
   * Funcion que maneja el blur en el campo correo
   */
  blurEmail = (event) => {
    let email = event.target.value;
    //let valid = email.match(/\S+@\S+\.\S+/g);
    if (!email.match(/\S/)){      
      document.getElementById('errorEmail').innerHTML = 'El campo correo no puede quedar vacío';
      event.target.style.backgroundColor = "yellow";
      event.target.focus = true;
      this.setState({emailIsValid: false}, () => {this.verifySubmit();});    
    }else{
      if (!email.match(/\S+@\S+\.\S+/g)){
        document.getElementById('errorEmail').innerHTML = 'El correo es inválido';
        event.target.style.backgroundColor = "yellow";
        event.target.focus = true;                              
        this.setState({emailIsValid: false}, () => {this.verifySubmit();});    
      }else{
        document.getElementById('errorEmail').innerHTML = '';
        event.target.style.backgroundColor = "white";
        this.setState({emailIsValid: true}, () => {this.verifySubmit();});            
      }            
    }  
  }

  /*
   * Funcion que maneja el campo nombre
   */
  changeName = (event) => {
    this.setState({name: event.target.value.toUpperCase()});    
  }   
  
  /*
   * Funcion que maneja el campo correo
   */
  changeEmail = (event) => {
    this.setState({email: event.target.value}); 
  }

  /*
   * Funcion que maneja el campo cedula
   */
  changeId = (event) => {
    this.setState({id: event.target.value});    
  }     
    
  /*
   * Funcion que maneja el campo telefono
   */    
  changePhone = (event) => {
    let phone = event.target.value;
    
    if (phone.match(/^\d{0,11}$/)){
      this.setState({phone: phone});              
    }
  }       
  
  /*
   * Funcion que maneja el campo estado
   */
  changeState = (event) => {
    this.setState({state: event.target.value});    
  }     
  
  /*
   * Funcion que maneja el campo ciudad
   */
  changeCity = (event) => {
    this.setState({city: event.target.value});    
  }     
  
  /*
   * Funcion que maneja el campo direccion
   */
  changeAddress = (event) => {
    this.setState({address: event.target.value});    
  }       
  
  /*handlePhone(event) {
    let phone = event.target.value;
    phone = phone.replace(/\D/g, '');
    let valid = phone.match(/^0?4{1}\d{9}$/g);
    if (!valid){
      alert('Numero de telefono invalido.');
      document.getElementById('idPhone').style.backgroundColor = "yellow";
      //document.getElementById('errorPhone').innerHTML = 'Numero invalido';
      //document.getElementById('idPhone').focus();
    }else{
      document.getElementById('idPhone').style.backgroundColor = "white";
      //document.getElementById('errorPhone').innerHTML = '';
    }
    //this.setState({phone: event.target.phone});
  }*/

  handleSubmit = (event) => {
    alert('A name was submitted: ' + this.state.name);
    console.log(this.state);
    event.preventDefault();
    return true;
  }  
  
  verifySubmit() {
    if ((this.state.nameIsValid)&&(this.state.emailIsValid))
      this.setState({disabledSubmit: false});
    else
      this.setState({disabledSubmit: true});  
  }    
  
  //Esta funcion muestra los componentes del formulario
  render() {
    return <div className="container">
      <h1>Registrar cuenta</h1>
      <form action="registrate.php" method="post" onSubmit={this.handleSubmit}>
        <div className="row">
          <div className="col-25">
            <label>Nombre</label>
          </div>
          <div className="col-75">
            <input type="text" id="idName" name="params[name]" placeholder="Nombre y apellido" value={this.state.name} onChange={this.changeName} onBlur={this.blurName}/>
            <div id="errorName" className="error"></div>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label>Correo electrónico</label>
          </div>
          <div className="col-75">
            <input type="text" id="idEmail" name="params[email]" placeholder="jose.perez@gmail.com" onBlur={this.blurEmail} onChange={this.changeEmail}/>
            <div id="errorEmail" className="error"></div>
          </div>
        </div>        
        <div className="row">
          <div className="col-25">
            <label>Cedula/ID</label>
          </div>
          <div className="col-75 short-input">
            <input type="text" name="params[id]" placeholder="Cédula/RIF" onChange={this.changeId}/>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label>Teléfono celular</label>
          </div>
          <div className="col-75 short-input">
            <input type="text" id = "idPhone" name="params[phone]" placeholder="04146320275" value={this.state.phone} onChange={this.changePhone}/>
            <span id='errorPhone'></span>
          </div>
        </div>
        <hr/>
        <h2>Dirección</h2>
        <div className="row">
          <div className="col-25">
            <label>Estado</label>
          </div>
          <div className="col-75 short-input">
            <input type="text" name="params[state]" placeholder="Estado de entrega" onChange={this.changeState}/>
          </div>
        </div>                        
        <div className="row">
          <div className="col-25">
            <label>Ciudad</label>
          </div>
          <div className="col-75 short-input">
            <input type="text" id="lCity" name="params[city]" placeholder="Ciudad de entrega" onChange={this.changeCity}/>
          </div>
        </div>        
        <div className="row">
          <div className="col-25">
            <label>Direccion de entrega</label>
          </div>
          <div className="col-75">
            <textarea id="lDeliverAddress" name="params[DeliverAddress]" placeholder="Dirección exacta de entrega" onChange={this.changeAddress}></textarea>            
          </div>
        </div>
        <div className="row">
          <input type="submit" disabled={this.state.disabledSubmit} value="Guardar"/>
        </div>        
      </form>        
      </div>;
  }
}

/*
 * Render the above component into the div#app
 */
ReactDOM.render(<Form />, document.getElementById('root'));