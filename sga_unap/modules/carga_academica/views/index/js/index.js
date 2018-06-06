var _post = null;
var _IdRegistro_ = 0;
var formulario = "";
$(document).on('ready', function() {
    $("#cursor").select2();
    $('#form3').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {} else {}
    });
    // Pagina para todas las listas INICIO 
    formulario = $("#formulario").val();
    $('body').on('click', '.pagina', function() {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"), $(this).attr("total_registros"));
    });
    $('body').on('change', '.s_filas', function() {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"), $(this).attr("total_registros"));
    });
    var paginacion = function(pagina, nombrelista, datos, total_registros) {
        var pagina = {
            'pagina': pagina,
            'nombrelista': nombrelista,
            'filas': $("#s_filas_" + nombrelista).val(),
            'total_registros': total_registros
        };
        $.post(_root_ + _modulo + '/' + _controlador + '/' + '_paginacion_' + nombrelista + '/' + datos, pagina, function(data) {
            $("#" + nombrelista).html('');
            $("#cargando").hide();
            $("#" + nombrelista).html(data);
        });
    }
    // Pagina para todas las listas FIN 
    //------------------------CURRICULA/FACULTAD/TODOS----------------------------//
    $("body").on('click', "#btnBuscarRegistros", function() {
        $("#cargando").show();
        buscarRegistros($("#palabraBusqueda").val());
    });
    $("body").on('click', '.estado-registro', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + _modulo + '/' + _controlador + '/' + '_cambiarEstado' + formulario, {
            _IdRegistro: _id_registro,
            _EstadoRegistro: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraBusqueda").val(),
            formulario: formulario,
            filas: $("#s_filas_listar" + formulario).val()
        }, function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
            // mensaje(JSON.parse(data));
        });
    });
    $("body").on('click', '.confirmar-eliminar-registro', function() {
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }
        _IdRegistro_ = _id_registro;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.eliminar_registro', function() {
        $("#cargando").show();
        // _Per_IdPermiso = _eliminar;
        _post = $.post(_root_ + _modulo + '/' + _controlador + '/' + '_eliminar' + formulario, {
            _IdRegistro: _IdRegistro_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraBusqueda").val(),
            formulario: formulario,
            filas: $("#s_filas_" + 'listar' + formulario).val()
        }, function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-registro', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }
        _IdRegistro_ = _id_registro;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + _modulo + '/' + _controlador + '/' + '_eliminar' + formulario, {
            _IdRegistro: _IdRegistro_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraBusqueda").val(),
            formulario: formulario,
            filas: $("#s_filas_" + 'listar' + formulario).val()
        }, function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
        });
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var bookId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find("#texto_").html(bookId);
    });
    //------------------------CURRICULA/FACULTAD/TODOS----------------------------/
    $("body").on('change', "#Cui_IdCurricula", function() {
        actualizarCurso($("#Cui_IdCurricula").val());
    });
    /*----------- Codigo de Jose-----------------*/
    // $(document).ready(function() {
    // $('.mdb-select').material_select();
    // });  
    $(document).on('change', "#selEscuela", function() {
        //console.log('entro 1');        
        actualizarcurricula($('#selEscuela').val());
    });
    $(document).on('change', "#selCurricula", function() {
        actualizarciclo_curricula($("#selCurricula").val());
        actualizarcursorequi($("#selCurricula").val());
    });

    function actualizarcurricula(Esc_IdEscuela) {
        // console.log('entro 2');
        $("cargando").show();
        $.post(_root_ + 'carga_academica/index/actualizarcurricula', {
            Esc_IdEscuela: Esc_IdEscuela
        }, function(data) {
            $("#selCurricula").html('');
            $("#cargando").hide();
            $("#selCurricula").html(data);
        });
    }

    function actualizarciclo_curricula(Cui_IdCurricula) {
        $("cargando").show();
        $.post(_root_ + 'carga_academica/index/actualizarciclo_curricula', {
            Cui_IdCurricula: Cui_IdCurricula
        }, function(data) {
            console.log(data);
            $("#selciclo_curricula").html('');
            $("#cargando").hide();
            $("#selciclo_curricula").html(data);
        });
    }

    function actualizarcursorequi(Cui_IdCurricula) {
        $("cargando").show()
        $.post(_root_ + 'carga_academica/index/actualizarcursorequi', {
            Cui_IdCurricula: Cui_IdCurricula
        }, function(data) {
            $("#cursor").html('');
            $("#cargando").hide();
            $("#cursor").html(data);
        });
    }
    // $("body").on('click', ".idioma_s", function () {
    //     var id = $(this).attr("id");
    //     var idIdioma = $("#hd_" + id).val();
    //     gestionIdiomas($("#idRol").val(), $("#idIdiomaOriginal").val(), idIdioma);
    // });
    //------------------------ESCUELAS----------------------------//
    $("body").on('click', "#buscarEscuela", function() {
        $("#cargando").show();
        buscarEscuela($("#palabra").val());
    });
    $("body").on('click', '.estado-permiso', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_permiso = $(this).attr("id_permiso");
        if (_id_permiso === undefined) {
            _id_permiso = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + 'carga_academica/index/_cambiarEstadoPermisos', {
            _Per_IdPermiso: _id_permiso,
            _Per_Estado: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraPermiso").val(),
            filas: $("#s_filas_" + 'listarPermisos').val()
        }, function(data) {
            $("#listarPermisos").html('');
            $("#cargando").hide();
            $("#listarPermisos").html(data);
            // mensaje(JSON.parse(data));
        });
    });
    $("body").on('click', '.confirmar-eliminar-permiso', function() {
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_permiso = $(this).attr("id_permiso");
        if (_id_permiso === undefined) {
            _id_permiso = 0;
        }
        _Per_IdPermiso_ = _id_permiso;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.eliminar_permiso', function() {
        $("#cargando").show();
        // _Per_IdPermiso = _eliminar;
        _post = $.post(_root_ + 'carga_academica/index/_eliminarPermiso', {
            _Per_IdPermiso: _Per_IdPermiso_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraPermiso").val(),
            filas: $("#s_filas_" + 'listarPermisos').val()
        }, function(data) {
            $("#listarPermisos").html('');
            $("#cargando").hide();
            $("#listarPermisos").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-permiso', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_permiso = $(this).attr("id_permiso");
        if (_id_permiso === undefined) {
            _id_permiso = 0;
        }
        _Per_IdPermiso_ = _id_permiso;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'carga_academica/index/_eliminarPermiso', {
            _Per_IdPermiso: _Per_IdPermiso_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraPermiso").val(),
            filas: $("#s_filas_" + 'listarPermisos').val()
        }, function(data) {
            $("#listarPermisos").html('');
            $("#cargando").hide();
            $("#listarPermisos").html(data);
        });
    });
    //------------------------FACULTAD-----------------------------//
    // $("body").on('click', "#buscar", function () {  
    //     $("#cargando").show();     
    //     buscarFacultad($("#palabraFacultad").val());
    // });
    // // OK
    // $("body").on('click', '.estado-facultad', function() {
    //     $("#cargando").show();
    //     if (_post && _post.readyState != 4) {
    //         _post.abort();
    //     }
    //     _IdFacultad = $(this).attr("id_facultad");
    //     if (_IdFacultad === undefined) {
    //         _IdFacultad = 0;
    //     }
    //     _estado = $(this).attr("estado");
    //     if (_estado === undefined) {
    //         _estado = 0;
    //     }
    //     if (!_estado) {
    //         _estado = 0;
    //     }
    //     _post = $.post(_root_ + _modulo + '/' + _controlador + '/' +  '_cambiarEstadoFacultad',
    //             {                    
    //                 _Fac_IdFacultad: _IdFacultad,
    //                 _Fac_Estado: _estado,
    //                 pagina: $(".pagination .active span").html(),
    //                 palabra: $("#palabraFacultad").val(),
    //                 filas:$("#s_filas_"+'listarFacultades').val()
    //             },
    //     function(data) {
    //         $("#listarFacultades").html('');
    //         $("#cargando").hide();
    //         $("#listarFacultades").html(data);
    //         // mensaje(JSON.parse(data));
    //     });
    // });
    // $("body").on('click', '.confirmar-eliminar-rol', function() {
    //     if (_post && _post.readyState != 4) {
    //         _post.abort();
    //     }
    //     _IdFacultad = $(this).attr("id_facultad");
    //     if (_IdFacultad === undefined) {
    //         _IdFacultad = 0;
    //     }
    //     _Fac_IdFacultad_ = _IdFacultad;
    //     _Row_Estado_ = 0;
    // });
    // $("body").on('click', '.eliminar_rol', function() {
    //     $("#cargando").show();
    //     // _Per_IdPermiso = _eliminar;
    //     _post = $.post(_root_ + 'carga_academica/index/_eliminarRol',
    //             {                    
    //                 _Fac_IdFacultad: _Fac_IdFacultad_,
    //                 _Row_Estado: _Row_Estado_,
    //                 pagina: $(".pagination .active span").html(),
    //                 palabra: $("#palabraFacultad").val(),
    //                 filas:$("#s_filas_"+'listarFacultades').val()
    //             },
    //     function(data) {
    //         $("#listarFacultades").html('');
    //         $("#cargando").hide();
    //         $("#listarFacultades").html(data);
    //     });
    // });
    // $("body").on('click', '.confirmar-habilitar-rol', function() {
    //     $("#cargando").show();
    //     if (_post && _post.readyState != 4) {
    //         _post.abort();
    //     }
    //     _IdFacultad = $(this).attr("id_facultad");
    //     if (_IdFacultad === undefined) {
    //         _IdFacultad = 0;
    //     }
    //     _Fac_IdFacultad_ = _IdFacultad;
    //     _Row_Estado_ = 1;
    //     _post = $.post(_root_ + 'carga_academica/index/_eliminarRol',
    //             {                    
    //                 _Fac_IdFacultad: _Fac_IdFacultad_,
    //                 _Row_Estado: _Row_Estado_,
    //                 pagina: $(".pagination .active span").html(),
    //                 palabra: $("#palabraFacultad").val(),
    //                 filas:$("#s_filas_"+'listarFacultades').val()
    //             },
    //     function(data) {
    //         $("#listarFacultades").html('');
    //         $("#cargando").hide();
    //         $("#listarFacultades").html(data);
    //     });
    // });
});
// function buscarFacultad(criterio) {
//     $.post(_root_ + _modulo + '/' + _controlador + '/' +  '_buscarFacultad',
//     {
//         palabra:criterio
//     }, function (data) {
//         $("#listarFacultades").html('');
//         $("#cargando").hide();
//         $("#listarFacultades").html(data);
//     });
// }
function buscarEscuela(criterio) {
    $("#cargando").show();
    $.post(_root_ + _modulo + '/' + _controlador + '/' + '_buscarEscuela', {
        palabra: criterio
    }, function(data) {
        $("#listarEscuelas").html('');
        $("#cargando").hide();
        $("#listarEscuelas").html(data);
    });
}
//General para todos
function buscarRegistros(criterio) {
    $("#cargando").show();
    $.post(_root_ + _modulo + '/' + _controlador + '/' + '_buscar' + formulario, {
        palabra: criterio,
        formulario: formulario
    }, function(data) {
        $("#listar" + formulario).html('');
        $("#cargando").hide();
        $("#listar" + formulario).html(data);
    });
}

function actualizarCurso(Cui_IdCurricula) {
    $("#cargando").show();
    $.post(_root_ + _modulo + '/' + _controlador + '/' + '_actualizarCurso', {
        Cui_IdCurricula: Cui_IdCurricula
    }, function(data) {
        $("#Cur_IdCurso").html('');
        $("#cargando").hide();
        $("#Cur_IdCurso").html(data);
    });
}
// function gestionIdiomas(idrol, idIdiomaOriginal, idIdioma) {
//     $("#cargando").show();
//     $.post(_root_ + _modulo + '/' + _controlador + '/' +  'gestion_idiomas_rol',
//             {
//                 idrol: idrol,        
//                 idIdioma: idIdioma,
//                 idIdiomaOriginal: idIdiomaOriginal
//             }, function (data) {
//         $("#gestion_idiomas_rol").html('');
//         $("#cargando").hide();
//         $("#gestion_idiomas_rol").html(data);
//         $('form').validator();
//     });
// }
/////////// codigo de JOSE ///////////////7
$(document).on('change', "#selEscuela", function() {
    //console.log('entro 1');        
    actualizarcurricula($('#selEscuela').val());
});
$(document).on('change', "#selCurricula", function() {
    actualizarciclo_curricula($("#selCurricula").val());
    actualizarcursorequi($("#selCurricula").val());
});

function actualizarcurricula(Esc_IdEscuela) {
    // console.log('entro 2');
    $("cargando").show();
    $.post(_root_ + 'carga_academica/index/actualizarcurricula', {
        Esc_IdEscuela: Esc_IdEscuela
    }, function(data) {
        $("#selCurricula").html('');
        $("#cargando").hide();
        $("#selCurricula").html(data);
    });
}

function actualizarciclo_curricula(Cui_IdCurricula) {
    $("cargando").show();
    $.post(_root_ + 'carga_academica/index/actualizarciclo_curricula', {
        Cui_IdCurricula: Cui_IdCurricula
    }, function(data) {
        console.log(data);
        $("#selciclo_curricula").html('');
        $("#cargando").hide();
        $("#selciclo_curricula").html(data);
    });
}

function actualizarcursorequi(Cui_IdCurricula) {
    $("cargando").show()
    $.post(_root_ + 'carga_academica/index/actualizarcursorequi', {
        Cui_IdCurricula: Cui_IdCurricula
    }, function(data) {
        $("#cursor").html('');
        $("#cargando").hide();
        $("#cursor").html(data);
    });
}
$("body").on('click', "#buscar", function() {
    $("#cargando").show();
    buscarCurso($("#palabraCurso").val());
});

function buscarCurso(criterio) {
    $.post(_root_ + 'carga_academica/index/_buscarCurso', {
        palabra: criterio
    }, function(data) {
        $("#listaregistros").html('');
        $("#cargando").hide();
        $("#listarCurso").html(data);
    });
}