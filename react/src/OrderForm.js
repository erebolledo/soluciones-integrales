import React from 'react';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import 'react-datepicker/dist/react-datepicker.css';

/*
 * Formulario para ordenes nuevas
 */
class OrderForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = 
        {
            numOrder: '',
            numTracking: '',
            store: '',
            date: moment(),
            observations: '',
            numOrderIsValid: false,
            disabledSubmit: 'btn btn-primary disabled'
        };
    //this.blurName = this.blurName.bind(this);
  }
  
    /*
     * Funcion que maneja el blur en el campo numero de orden
     */
    blurNumOrder = (event) => {    
        let numOrder = event.target.value;
        if (!numOrder.match(/\S/)){
            document.getElementById('errorNumOrder').innerHTML = 'El campo número de orden no puede quedar vacío';
            event.target.style.backgroundColor = "yellow";
            event.target.focus = true;
            this.setState({numOrderIsValid: false}, () => {this.verifySubmit();});    
        }else{
            document.getElementById('errorNumOrder').innerHTML = '';
            event.target.style.backgroundColor = "white";
            this.setState({numOrderIsValid: true}, () => {this.verifySubmit();});
        }
    }         

    /*
     * Funcion que maneja el campo numero de orden
     */
    changeNumOrder = (event) => {
        this.setState({numOrder: event.target.value});    
    }   

    /*
     * Funcion que maneja el campo correo
     */
    changeNumTracking = (event) => {
        this.setState({numTracking: event.target.value}); 
    }
    
    /*
     * Funcion que captura la fecha del datepicker
     */
    changeDate = (date) =>{
        this.setState({date: date}); 
    }

    /*
     * Funcion para manejar el envio del formulario
     */
    handleSubmit = () => {
        if (this.state.numOrderIsValid){            
            document.getElementById("form").submit();
            return true;
        }else{
            alert("Favor llenar los campos necesarios del formulario", "Aceptar");
            return false;
        }                
    }  
    
    verifySubmit() {
        if (this.state.numOrderIsValid)
            this.setState({disabledSubmit: 'btn btn-primary'});
        else
            this.setState({disabledSubmit: 'btn btn-primary disabled'});     
    }    
  
  //Esta funcion muestra los componentes del formulario
  render() {
    return <div className="container-form">
  <form id="form" action="/order-save" method="post" onSubmit={this.handleSubmit}>
    <div className="row">
      <label className="col-25">Número de orden:</label>
      <div className="col-50">
        <input className="form-control" id="n_order" placeholder="Introduca el número de orden" name="n_order" 
            value={this.state.numOrder} onChange={this.changeNumOrder} onBlur={this.blurNumOrder}/>
        <div id="errorNumOrder" className="error"></div>
      </div>
    </div>
    <div className="row">
      <label className="col-25">Número de Tracking:</label>
      <div className="col-50">          
        <input className="form-control" id="n_tracking" placeholder="Introduzca el número de tracking" name="n_tracking"/>
      </div>
    </div>
    <div className="row">
      <label className="col-25">Tienda/Origen:</label>
      <div className="col-50">          
          <select className="form-control">
            <option>Amazon</option>
            <option>Ebay</option>
            <option>Walmart</option>
            <option>Locatel</option>
            <option>Otro</option>
          </select>
      </div>
    </div>    
    <div className="row">
      <label className="col-25">Fecha de compra:</label>
      <div className="col-50">          
        <DatePicker
            selected={this.state.date}
            onChange={this.changeDate}
            dateFormat="DD/MM/YYYY"
            placeholderText="Fecha de la compra" 
        />
      </div>
    </div>        
    <div className="row">
      <label className="col-25">Observaciones:</label>
      <div className="col-50">          
      <textarea className="form-control" id="observations" name="observations" rows="3"></textarea>        
      </div>
    </div>            
    <div className="row">        
      <div className="col-sm-offset-2 col-sm-10">
        <input type="button" className={this.state.disabledSubmit} value="Guardar" onClick={this.handleSubmit}/>
      </div>
    </div>
  </form>      
  </div>;
  }
}

export default OrderForm;