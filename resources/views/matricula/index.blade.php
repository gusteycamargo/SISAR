@extends('templates.main', ['titulo' => "Matrículas", 'tag' => "MATRICULA"])

@section('conteudo')
 
     <div class='row'>
         <div class='col-sm-2'>
            <a class="btn btn-secondary btn-block bg-dark" href="{{ route('alunos.index') }}">
                <b>Voltar</b>
            </a>
         </div>
        <div class='col-sm-10'>
            <div class="navbar navbar-expand-sm navbar-dark alert-secondary d-flex justify-content-between">
                <div>
                    <img width="36px" height="36px" src="{{ asset('img/curso_ico.png') }}">
                    <a class="navbar-brand mx-auto">
                        <p>{{$aluno['curso']['nome']}}</p>
                    </a>
                </div>
                <div>
                    <img width="36px" height="36px" src="{{ asset('img/aluno_ico.png') }}">
                    <a class="navbar-brand mx-auto">
                        <p>{{$aluno['nome']}}</p>
                    </a>
                </div>
            </div>
        </div>
     </div>
     <div class='row'>
       <div class='col-sm-12'>
           <div class="alert alert-primary d-flex justify-content-center">
               <div class="d-flex justify-content-center">
                    <img width="36px" height="36px" src="{{ asset('img/conceito_ico.png') }}">
                    <a class="navbar-brand mx-auto">
                        <b>Matrículas do aluno</b>
                    </a>
               </div>
           </div>
       </div>
    </div>


    <div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
        <table class='table table-striped' id="tabela">
            <tbody id="tbod">
                
            </tbody>
        </table>
    </div>

    <div class='row'>
        <div class='col-sm-12'>
           <button class="btn btn-primary btn-block" onclick="criar()">
               <b>Confirmar Matrículas</b>
           </button>
        </div>
    </div>

     <br>

@endsection

@section('script')


    <script type="text/javascript">
        function loadDisciplinasDoCurso(id) {
            $.getJSON('/api/cursos/'+id, function (data) {
                for(i = 0; i < data.disciplina.length; i++) {
                    item = "<tr>"+
                        "<td>"+
                            "<div class='custom-control custom-checkbox'>"+
                                "<input type='checkbox' class='custom-control-input' id='customCheck"+i+"'>"+
                                "<label class='custom-control-label' for='customCheck"+i+"'>"+data.disciplina[i].nome+"</label>"+
                            "</div>"+   
                        "</td>"+
                    "</tr>"
                    $('#tbod').append(item);
                }
                console.log(data);
            })
        }

        $(function() {
            let a = {!! json_encode($aluno) !!}
            loadDisciplinasDoCurso(a.curso.id);
        })

        
        function criar() {
            $('#modalAluno').modal().find('.modal-title').text("Novo Aluno");
            $('#nome').val('');
            $('#email').val('');
            $('#curso').val('');
            $('#modalAluno').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formAlunos").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalAluno').modal('hide')
        })

        function insert() {
            alunos = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                curso: $("#curso").val(),
            };
            $.post("/api/alunos", alunos, function(data) {
                novoAluno = JSON.parse(data);
                console.log(novoAluno);
                linha = getLin(novoAluno);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            alunos = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                curso: $("#curso").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/alunos/"+id,
                context: this,
                data: alunos,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    const dataParse = (JSON.parse(data));
                    e = linhas.filter( function(i, e) {
                        return e.cells[0].textContent == dataParse.id;
                    } );
                    console.log(e[0]);

                    if(e) {
                        e[0].cells[1].textContent = dataParse.nome;
                        e[0].cells[2].textContent = dataParse.email;
                        e[0].cells[3].textContent = dataParse.curso.nome;
                    }
                },
                error: function(error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function returnOptionsDisciplina(disciplina) {
            let options = '';
            if(typeof disciplina != 'undefined' && disciplina.length > 0) {
                for (const a of disciplina) {
                    options = options + " "+ "<option>"+a.nome+"</option>"
                }
            }
            return options
        }

        function getLin(aluno) {
            let options = returnOptionsDisciplina(aluno.disciplina);
            console.log(aluno);
            var linha = 
            "<tr style='text-align: center'>"+
                "<td style='display: none'>"+ aluno.id +"</td>"+
                "<td>"+ aluno.nome +"</td>"+
                "<td>"+ aluno.email +"</td>"+
                "<td>"+aluno.curso.nome+"</td>"+
                "<td>"+
                    "<select class='form-control'>"+
                        options+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+aluno.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+aluno.id+")'><img src='{{ asset('img/icons/config.svg') }}'></a>"+
                "</td>"+
            "</tr>";

            return linha;
        }

        function editar(id) { 
            $('#modalAluno').modal().find('.modal-title').text("Alterar Aluno");

            $.getJSON('/api/alunos/'+id, function(data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#curso').val(data.curso);
                $('#modalAluno').modal('show');
            });
        }

    </script>

@endsection