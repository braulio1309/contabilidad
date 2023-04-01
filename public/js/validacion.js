function validarCedula(numero = '') {
    // fuerzo parametro de entrada a string
    numero = String(numero);
  
    // borro por si acaso errores de llamadas anteriores.
    this.setError('');
  
    // validaciones
    try {
      this.validarInicial(numero, '10');
      this.validarCodigoProvincia(numero.slice(0, 2));
      this.validarTercerDigito(numero[2], 'cedula');
      this.algoritmoModulo10(numero.slice(0, 9), numero[9]);
    } catch (e) {
      this.setError(e.message);
      return false;
    }
  
    return true;
  }

  function validarRucPersonaNatural(numero = '') {
    // fuerzo parametro de entrada a string
    numero = String(numero);
  
    // borro por si acaso errores de llamadas anteriores.
    setError('');
  
    // validaciones
    try {
      validarInicial(numero, '13');
      validarCodigoProvincia(numero.slice(0, 2));
      validarTercerDigito(numero[2], 'ruc_natural');
      validarCodigoEstablecimiento(numero.slice(10, 13));
      algoritmoModulo10(numero.slice(0, 9), numero[9]);
    } catch (e) {
      setError(e.message);
      return false;
    }
  
    return true;
  }
  
  function validarRucSociedadPrivada(numero = '') {
    // fuerzo parametro de entrada a string
    numero = String(numero);
  
    // borro por si acaso errores de llamadas anteriores.
    setError('');
  
    // validaciones
    try {
      validarInicial(numero, '13');
      validarCodigoProvincia(numero.slice(0, 2));
      validarTercerDigito(numero[2], 'ruc_privada');
      validarCodigoEstablecimiento(numero.slice(10, 13));
      algoritmoModulo11(numero.slice(0, 9), numero[9], 'ruc_privada');
    } catch (e) {
      setError(e.message);
      return false;
    }
  
    return true;
  }
  
  function validarRucSociedadPublica(numero) {
    numero = String(numero);
    this.setError('');

    try {
        validarInicial(numero, '13');
        validarCodigoProvincia(numero.substring(0, 2));
        validarTercerDigito(numero[2], 'ruc_publica');
        validarCodigoEstablecimiento(numero.substring(9, 13));
        algoritmoModulo11(numero.substring(0, 8), numero[8], 'ruc_publica');
    } catch (e) {
        this.setError(e.message);
        return false;
    }

    return true;
  }
  
  function validarInicial(numero, caracteres) {
    if (!numero) {
      throw new Error('Valor no puede estar vacio');
    }
  
    if (!/^\d+$/.test(numero)) {
      throw new Error('Valor ingresado solo puede tener dígitos');
    }
  
    if (numero.length !== Number(caracteres)) {
      throw new Error(`Valor ingresado debe tener ${caracteres} caracteres`);
    }
  
    return true;
  }
  
  function validarCodigoProvincia(numero) {
    if (numero < 0 || numero > 24) {
      throw new Error('Codigo de Provincia (dos primeros dígitos) no deben ser mayor a 24 ni menores a 0');
    }
  
    return true;
  }

  function validarCodigoEstablecimiento(numero) {
    if (numero < 1) {
      throw new Error('Código de establecimiento no puede ser 0');
    }
  
    return true;
  }
  
  function validarTercerDigito(numero, tipo) {
    switch (tipo) {
      case 'cedula':
      case 'ruc_natural':
        if (numero < 0 || numero > 5) {
          throw new Error('Tercer dígito debe ser mayor o igual a 0 y menor a 6 para cédulas y RUC de persona natural');
        }
        break;
      case 'ruc_privada':
        if (numero != 9) {
          throw new Error('Tercer dígito debe ser igual a 9 para sociedades privadas');
        }
        break;
  
      case 'ruc_publica':
        if (numero != 6) {
          throw new Error('Tercer dígito debe ser igual a 6 para sociedades públicas');
        }
        break;
      default:
        throw new Error('Tipo de Identificacion no existe.');
        break;
    }
  
    return true;
  }
  
  function algoritmoModulo10(digitosIniciales, digitoVerificador) {
    const arrayCoeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
  
    digitoVerificador = Number(digitoVerificador);
    digitosIniciales = digitosIniciales.split('');
  
    let total = 0;
    digitosIniciales.forEach((value, key) => {
      let valorPosicion = Number(value) * arrayCoeficientes[key];
  
      if (valorPosicion >= 10) {
        valorPosicion = String(valorPosicion)
          .split('')
          .reduce((acc, cur) => Number(acc) + Number(cur), 0);
      }
  
      total += valorPosicion;
    });
  
    const residuo = total % 10;
    const resultado = residuo === 0 ? 0 : 10 - residuo;
  
    if (resultado !== digitoVerificador) {
      throw new Error('Dígitos iniciales no validan contra Dígito Idenficador');
    }
  
    return true;
  }

  function algoritmoModulo11(digitosIniciales, digitoVerificador, tipo) {
    let arrayCoeficientes;
    
    switch (tipo) {
      case 'ruc_privada':
        arrayCoeficientes = [4, 3, 2, 7, 6, 5, 4, 3, 2];
        break;
      case 'ruc_publica':
        arrayCoeficientes = [3, 2, 7, 6, 5, 4, 3, 2];
        break;
      default:
        throw new Error('Tipo de Identificacion no existe.');
    }
  
    digitoVerificador = parseInt(digitoVerificador);
    digitosIniciales = digitosIniciales.split('');
  
    let total = 0;
    digitosIniciales.forEach((value, key) => {
      const valorPosicion = parseInt(value) * arrayCoeficientes[key];
      total += valorPosicion;
    });
  
    const residuo = total % 11;
  
    const resultado = (residuo === 0) ? 0 : 11 - residuo;
  
    if (resultado !== digitoVerificador) {
      throw new Error('Dígitos iniciales no validan contra Dígito Idenficador');
    }
  
    return true;
  }

  
  
  function getError(newError) {
    return this.error;
  }
  function setError(newError) {
    this.error = newError;
    return this;
  }