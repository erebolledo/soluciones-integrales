import React from 'react';
//var axios = require('axios');

/*
 * Formulario para calculo de peso envios.solinte
 */
class CalculatorForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = 
      {
        id: '-1',  
        long: '',
        wide: '',
        high: '',
/*        identification: '',
        password: '',
        state: '',
        city: '',
        address: '',
        nameIsValid: false,
        emailIsValid: false,
        passIsValid: false,
        disabledSubmit: 'btn btn-primary disabled',*/
        _token: document.getElementById('_token').value
      };
      
      //this.server = document.getElementById('server').value;

    //this.blurName = this.blurName.bind(this);
  }  
    
    /*
     * Funcion que maneja el campo largo
     */    
    changeLong = (event) => {
        let long = event.target.value;

        if (long.match(/\d{0,}/)){
            console.log('aja');
            this.setState({long: long});              
        }
    }   
    
    /*
     * Funcion que maneja el campo ancho
     */    
    changeWide = (event) => {
        let wide = event.target.value;

        if (wide.match(/\d|,|\./g)){
            this.setState({wide: wide});              
        }
    }   
    
    /*
     * Funcion que maneja el campo alto
     */    
    changeHigh = (event) => {
        let high = event.target.value;

        if (high.match(/^\d?|,|\.$/)){
            this.setState({high: high});              
        }
    }         
    
    handleSubmit = () => {
        alert(this.server);

        if ((this.state.emailIsValid)&&(this.state.nameIsValid)&&(this.state.passIsValid)){            
            /*axios.post('http://localhost/api/account/store', JSON.stringify(this.state))
            .then(function (response){
                let id = response.data.id;
                console.log(id);
                window.open('/account/'+id+'/show/created','_self');
                let token = response.data.token;
                window.printModal(token);
            })
            .catch(function (error) {
                console.log(error);
            });*/            
            console.log('almacenando');
            document.getElementById("regForm").submit();
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
        <h3>Datos del paquete</h3>
        <form name="form" id="regForm" method="post" action="/account/store">
            <div className="row">
                <div className="col-25">
                    <label>Medidas en</label>
                </div>
                <div className="col-50">
                    <div className="ninety-px-left">
                        <select className="form-control" id="measure">
                            <option>cm</option>
                            <option>pulgadas</option>
                        </select>
                    </div>                    
                </div>
            </div>    
            <div className="row">
                <div className="col-25">
                    <label>Largo</label>
                </div>
                <div className="col-50">
                    <input type="text" id="long" name="long" placeholder="Ejemplo: 2.5" value={this.state.long} onChange={this.changeLong}/>
                    <div id="errorLong" className="error"></div>
                </div>
            </div>                    
            <div className="row">
                <div className="col-25">
                    <label>Ancho</label>
                </div>
                <div className="col-50">
                    <input type="text" id="wide" name="wide" placeholder="Ejemplo: 1.8" value={this.state.wide} onChange={this.changeWide}/>
                    <div id="errorWide" className="error"></div>
                </div>
            </div>                    
            <div className="row">
                <div className="col-25">
                    <label>Alto</label>
                </div>
                <div className="col-50">
                    <input type="text" id="high" name="high" placeholder="Ejemplo: 8" value={this.state.high} onChange={this.changeHigh}/>
                    <div id="errorHigh" className="error"></div>
                </div>
            </div>                        
            <div className="row">
                <div className="col-25">
                    <label>Peso</label>
                </div>
                <div className="col-50">
                    <div className="eighty-left">
                        <input type="text" id="weight" name="weight" placeholder="Ejemplo: 5.4"/>
                    </div>    
                    <div className="twenty-left">
                        <select className="form-control" id="weightUnit">
                            <option>kg</option>
                            <option>lb</option>
                        </select>
                    </div>                    
                    <div id="errorWeight" className="error"></div>
                </div>
            </div>                                    
            <hr/>
            <div className="row">
                <div className="col-25">
                    <label>Costo del envio</label>
                </div>
                <div className="col-50">
                    <div className="eighty-left">
                        <input type="text" id="price" name="price" readOnly/>
                    </div>
                    <div className="twenty-left">
                        <select className="form-control" id="moneyUnit">
                            <option>BsF</option>
                            <option>$</option>
                        </select>
                    </div>
                    <div id="errorHigh" className="error"></div>
                </div>
            </div>                                    
        </form>
    </div> ;
  }
}

export default CalculatorForm;