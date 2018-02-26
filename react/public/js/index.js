var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

/*
 * Formulario de registro en envios.solinte
 */
var Form = function (_React$Component) {
  _inherits(Form, _React$Component);

  function Form(props) {
    _classCallCheck(this, Form);

    var _this = _possibleConstructorReturn(this, (Form.__proto__ || Object.getPrototypeOf(Form)).call(this, props));

    _this.blurEmail = function (event) {
      var email = event.target.value;
      var valid = email.match(/\S+@\S+\.\S+/g);
      if (!email.match(/\S/)) {
        _this.error("idEmail", "El campo Correo no puede estar vacio");
        event.target.style.backgroundColor = "yellow";
        event.target.focus;
        _this.setState({ emailIsValid: false });
      } else {
        if (!email.match(/\S+@\S+\.\S+/g)) {
          _this.error("idEmail", "El Correo es invalido");
          event.target.style.backgroundColor = "yellow";
          event.target.focus;
          _this.setState({ emailIsValid: false });
        } else {
          _this.error("idEmail", false);
          event.target.style.backgroundColor = "white";
          _this.setState({ emailIsValid: true });
          _this.verifySubmit();
        }
      }
    };

    _this.changeName = function (event) {
      _this.setState({ name: event.target.value.toUpperCase() });
    };

    _this.changePhone = function (event) {
      var phone = event.target.value;
      var key = event.keyCode;
      console.log(key);

      if (phone.match(/^\d{0,11}$/)) {
        //if ((!phone.match(/^\D/))&&(phone.match(/^\S{0,12}$/))){
        /*if (phone.match(/^\d{4}$/)){
          phone = event.target.value+"-";
        }*/
        _this.setState({ phone: phone });
      }
    };

    _this.blurName = function (event) {
      var name = event.target.value;
      if (!name.match(/\S/)) {
        _this.error("idName", "El campo Nombre no puede quedar vacio");
        event.target.style.backgroundColor = "yellow";
        event.target.focus;
      } else {
        _this.error("idName", false);
        event.target.style.backgroundColor = "white";
        _this.setState({ nameIsValid: true });
        _this.verifySubmit();
      }
    };

    _this.handleSubmit = function (event) {
      alert('A name was submitted: ' + _this.state.name);
      event.preventDefault();
    };

    _this.state = {
      name: '',
      phone: '',
      email: '',
      nameIsValid: false,
      emailIsValid: false,
      disabledSubmit: true
    };
    //this.blurName = this.blurName.bind(this);
    return _this;
  }

  _createClass(Form, [{
    key: 'handlePhone',
    value: function handlePhone(event) {
      var phone = event.target.value;
      phone = phone.replace(/\D/g, '');
      var valid = phone.match(/^0?4{1}\d{9}$/g);
      if (!valid) {
        alert('Numero de telefono invalido.');
        document.getElementById('idPhone').style.backgroundColor = "yellow";
        //document.getElementById('errorPhone').innerHTML = 'Numero invalido';
        //document.getElementById('idPhone').focus();
      } else {
        document.getElementById('idPhone').style.backgroundColor = "white";
        //document.getElementById('errorPhone').innerHTML = '';
      }
      //this.setState({phone: event.target.phone});
    }
  }, {
    key: 'verifySubmit',
    value: function verifySubmit() {
      if (this.state.nameIsValid && this.state.emailIsValid) this.setState({ disabledSubmit: false });

      console.log(this.state.nameIsValid);
      console.log(this.state.emailIsValid);
      console.log(this.state.disabledSubmit);
    }
  }, {
    key: 'error',
    value: function error(field, value) {
      if (!value) document.getElementById(field).placeholder = "";else document.getElementById(field).placeholder = value;
    }

    //Esta funcion muestra los componentes del formulario

  }, {
    key: 'render',
    value: function render() {
      return React.createElement(
        'div',
        { className: 'container' },
        React.createElement(
          'h1',
          null,
          'Registrar cuenta'
        ),
        React.createElement(
          'form',
          { onSubmit: this.handleSubmit },
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lName' },
                'Nombre'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75' },
              React.createElement('input', { type: 'text', id: 'idName', name: 'params[name]', placeholder: 'Nombre y apellido', value: this.state.name, onChange: this.changeName, onBlur: this.blurName })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lEmail' },
                'Correo electronico'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75' },
              React.createElement('input', { type: 'text', id: 'idEmail', name: 'params[email]', placeholder: 'jose.perez@gmail.com', onBlur: this.blurEmail })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lId' },
                'Cedula/ID'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75 short-input' },
              React.createElement('input', { type: 'text', name: 'params[id]', placeholder: 'Cedula o documento de identidad' })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lPhone' },
                'Telefono celular'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75 short-input' },
              React.createElement('input', { type: 'text', id: 'idPhone', name: 'params[phone]', placeholder: '04146320275', value: this.state.phone, onChange: this.changePhone }),
              React.createElement('span', { id: 'errorPhone' })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lCity' },
                'Ciudad'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75 short-input' },
              React.createElement('input', { type: 'text', id: 'lCity', name: 'params[city]', placeholder: 'Ciudad de entrega' })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lState' },
                'Estado'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75 short-input' },
              React.createElement('input', { type: 'text', name: 'params[state]', placeholder: 'Estado de entrega' })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-25' },
              React.createElement(
                'label',
                { 'for': 'lDeliverAddress' },
                'Direccion de entrega'
              )
            ),
            React.createElement(
              'div',
              { className: 'col-75' },
              React.createElement('textarea', { id: 'lDeliverAddress', name: 'params[DeliverAddress]', placeholder: 'Direccion exacta de entrega' })
            )
          ),
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement('input', { type: 'submit', disabled: this.state.disabledSubmit, value: 'Guardar' })
          )
        )
      );
    }
  }]);

  return Form;
}(React.Component);

/*
 * Render the above component into the div#app
 */


React.render(React.createElement(Form, null), document.getElementById('app'));