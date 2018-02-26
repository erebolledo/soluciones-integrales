import React from 'react';
var axios = require('axios');

/*
 * Formulario de registro en envios.solinte
 */
class RegForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = 
      {
        id: '-1',  
        name: '',
        phone: '',
        email: '',
        identification: '',
        password: '',
        state: '',
        city: '',
        address: '',
        nameIsValid: false,
        emailIsValid: false,
        passIsValid: false,
        disabledSubmit: 'btn btn-primary disabled'
      };
    //this.blurName = this.blurName.bind(this);
  }
  
  componentDidMount(){
    let id = document.getElementById('userId').value;   
    if (id!=='-1'){
        axios.get('http://localhost/api/account/get/'+id)
        .then(response => {
            this.setState({
                id: response.data.id,
                name: response.data.name,
                email: response.data.email,
                identification: response.data.identification,
                phone: response.data.phone,
                password: response.data.password,
                state: response.data.state,
                city: response.data.city,
                address: response.data.address,
                nameIsValid: true,
                emailIsValid: true,
                passIsValid: true,
            });
            this.verifySubmit();
        })
        .catch(function (error) {
            console.log(error);
        });        
    }      
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
            if (this.emailExist(this)){
                                console.log('entre aca 2');
            }else {
                document.getElementById('errorEmail').innerHTML = '';
                event.target.style.backgroundColor = "white";
                this.setState({emailIsValid: true}, () => {this.verifySubmit();});            
            }
      }            
    }  
  }
  
    /*
     * Funcion que maneja el blur en el campo contraseña
     */
    blurPass = (event) => {    
        let pass = event.target.value;
        if (!pass.match(/\S/)){
            document.getElementById('errorPass').innerHTML = 'El campo contraseña no puede quedar vacío. Favor cree una contraseña';
            event.target.style.backgroundColor = "yellow";
            event.target.focus = true;
            this.setState({passIsValid: false}, () => {this.verifySubmit();});    
        }else{
            document.getElementById('errorPass').innerHTML = '';
            event.target.style.backgroundColor = "white";
            this.setState({passIsValid: true}, () => {this.verifySubmit();});
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
    this.setState({identification: event.target.value});    
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
    * Funcion que maneja el campo contraseña
    */
    changePass = (event) => {
        this.setState({password: event.target.value}); 
    }
  
    /*
     * Funcion que maneja el campo mostrar password
     */    
    changeShowPass = (event) => {
        let pass = document.getElementById('idPass');

        if (pass.type === "password")
            pass.type = "text";
        else
            pass.type = "password";
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
    
    emailExist(regform) {
        axios.get('http://localhost/api/account/exist/'+this.state.email)
        .then(function (response) {
            if (response.data.valueOf() > 0){
                document.getElementById('errorEmail').innerHTML = 'Ya existe una cuenta que utiliza este correo electrónico';                
                document.getElementById('idEmail').style.backgroundColor = "yellow";
                regform.setState({emailIsValid: false}, () => {regform.verifySubmit();});                  
            }    
        });        
    }
    
    handleSubmit = () => {
        if ((this.state.emailIsValid)&&(this.state.nameIsValid)&&(this.state.passIsValid)){            
            axios.post('http://localhost/api/account/add', JSON.stringify(this.state))
            .then(function (){
                window.printModal();
            })
            .catch(function (error) {
                console.log(error);
            });            
            return true;
        }else{
            alert('Faltan datos, revise el formulario');
            return false;
        }                
    }  
    
    /*
     * Funcion para guardar los datos
     *
    save(){
        alert('guardando...');
        
    }*/

  
  verifySubmit() {
    if ((this.state.nameIsValid)&&(this.state.emailIsValid)&&(this.state.passIsValid))
      this.setState({disabledSubmit: 'btn btn-primary'});
    else{
        this.setState({disabledSubmit: 'btn btn-primary disabled'});  
    }      
  }    
  
  //Esta funcion muestra los componentes del formulario
  render() {
    return <div className="container-form">
      <h3>Datos</h3>
      <form onSubmit={this.handleSubmit}>
        <input type="hidden" id="op" name="op" value="insert"/>
        <div className="row">
          <div className="col-25">
            <label>Nombre</label>
          </div>
          <div className="col-50">
            <input type="text" id="idName" ref={ref => this.name = ref} name="params[name]" placeholder="Nombre y apellido" value={this.state.name} onChange={this.changeName} onBlur={this.blurName}/>
            <div id="errorName" className="error"></div>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label>Correo electrónico</label>
          </div>
          <div className="col-50">
            <input type="text" id="idEmail" ref="email" name="params[email]" placeholder="jose.perez@gmail.com" value={this.state.email} onBlur={this.blurEmail} onChange={this.changeEmail}/>
            <div id="errorEmail" className="error"></div>
          </div>
        </div>        
        <div className="row">
          <div className="col-25">
            <label>Cedula/ID</label>
          </div>
          <div className="col-50">
            <input type="text" ref="identification" name="params[identification]" value={this.state.identification} placeholder="Cédula/RIF" onChange={this.changeId}/>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label>Teléfono celular</label>
          </div>
          <div className="col-50">
            <input type="text" id = "idPhone" ref="phone" name="params[phone]" placeholder="04146320250" value={this.state.phone} onChange={this.changePhone}/>
            <span id='errorPhone'></span>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label>Contraseña</label>
          </div>
          <div className="col-50">
            <input type="password" id = "idPass" ref="password" name="params[pass]" value={this.state.password} onChange={this.changePass} onBlur={this.blurPass}/>
            <div id="errorPass" className="error"></div>
          </div>
        </div>
        <div className="row">
          <div className="col-25">
            <label></label>
          </div>
          <div className="col-50">
          <input type="checkbox" id = "idShowPass" onChange={this.changeShowPass}/><label>&nbsp;Mostrar contraseña</label>          
          </div>
        </div>        
        <hr/>
        <h3>Dirección</h3>
        <div className="row">
          <div className="col-25">
            <label>Estado</label>
          </div>
          <div className="col-50">
            <input type="text" name="params[state]" ref="state" placeholder="Estado de entrega" value={this.state.state} onChange={this.changeState}/>
          </div>
        </div>                        
        <div className="row">
          <div className="col-25">
            <label>Ciudad</label>
          </div>
          <div className="col-50">
            <input type="text" id="lCity" name="params[city]" ref="city" placeholder="Ciudad de entrega" value={this.state.city} onChange={this.changeCity}/>
          </div>
        </div>        
        <div className="row">
          <div className="col-25">
            <label>Direccion de entrega</label>
          </div>
          <div className="col-50">
            <textarea id="lDeliverAddress" name="params[address]" ref="address" placeholder="Dirección exacta de entrega" value={this.state.address} onChange={this.changeAddress}></textarea>            
          </div>
        </div>        
        <div className="row">
            <div className="col-25"></div>
            <div className="col-50">
                <input type="button" className={this.state.disabledSubmit} value="Guardar" onClick={this.handleSubmit}/>
            </div>
        </div>        
      </form>        
      </div>;
  }
}

export default RegForm;