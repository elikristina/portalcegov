window.Kanban = {}

;
(function(exports) {

    var baseUrl = "/sipesq/index.php/atividade/saveActivity"

        function initKanban() {


            //registrar todos os listeners para a dropagem de itens
            $('.kanban-item').draggable({
                revert: 'invalid'
            })
            //$('.kanban-passo-item').draggable({ revert: "invalid" })

            $("#atv-list-todo").droppable({
                drop: todoDrop,
                hoverClass: "kanban-over",
                activeClass: "kanban-active"

            })

            $("#atv-list-done").droppable({
                drop: doneDrop,
                hoverClass: "kanban-over",
                activeClass: "kanban-active"

            })

            $("#atv-list-today").droppable({
                drop: todayDrop,
                hoverClass: "kanban-over",
                activeClass: "kanban-active"
                //accept: ".kanban-passo-item"

            })

            $('.ok-button').click(savePasso)


            $('.kanban-passo-item').hover(function() {
                $(this).addClass('kanban-passo-item-hover')
            }, function() {
                $(this).removeClass('kanban-passo-item-hover')
            })

            $('.drop-button').toggle(
                function() {
                    $(this).parent().find('.atv-passos').removeClass('hidden')
                    $(this).removeClass('ui-icon-circle-triangle-e').addClass('ui-icon-circle-triangle-s')

                },
                function() {
                    $(this).parent().find('.atv-passos').addClass('hidden')
                    $(this).removeClass('ui-icon-circle-triangle-s').addClass('ui-icon-circle-triangle-e')


                }

            )

            $(".update-form-button")
                .unbind('click')
                .click(function() {
                    var id = $(this).attr('cod_atividade')
                    alert(id)
                    //$( "#update-form" ).dialog( "open" )

                    $("#update-form").load("/sipesq/index.php/atividade/updateajax/" + id)
                })

        }


        function todayPassoDrop(event, ui) {


            var itemDrop = document.createElement('div')
            $(itemDrop).draggable({
                revert: "invalid"
            })
            $(itemDrop).append(ui.draggable.html())
            console.log(ui.draggable.parent().html())


            $(this).append(itemDrop)

            $('.ok-button').unbind('click').click(savePasso)
            ui.draggable.fadeOut(100)

            //Dispara as mudanças
            sendUpdates()
        }


        function todayDrop(event, ui) {

            var atividade = ui.draggable.clone()

            var id = atividade.find('.atividade').attr('atv-id')
            var novaAtividade = document.createElement('div')

            $.post(baseUrl, {
                id: id,
                status: 1
            }, function(data) {
                $(novaAtividade)
                    .append(data)
                    .addClass('kanban-item')
                    .draggable({
                        revert: "invalid"
                    })
                    .find('.view')
                    .removeClass('verde amarelo vermelho branco')
                    .addClass('vermelho')

            }).complete(
                function() {
                    registerActivityListeners()
                    console.log('\nAtividade ' + id + ' salva na aba TODAY.')
                })

            $(this).append(novaAtividade)

            ui.draggable.fadeOut(100)

            //Dispara as mudanças
            sendUpdates()

        }

        function doneDrop(event, ui) {

            var id = ui.draggable.find('.atividade').attr('atv-id')
            var itemDrop = document.createElement('div')

            $.post(baseUrl, {
                id: id,
                status: 2
            }, function(data) {


                $(itemDrop)
                    .append(data)
                    .addClass('kanban-item')
                    .draggable({
                        revert: "invalid"
                    })
                    .find('.view')
                    .removeClass('verde amarelo vermelho branco')
                    .addClass('verde')
            }).complete(
                function() {
                    registerActivityListeners()
                    console.log('\nAtividade ' + id + ' salva na aba DONE.')
                })

            $(this).append(itemDrop)
            ui.draggable.fadeOut(100)

            //Dispara as mudanças
            sendUpdates()
        }

        function todoDrop(event, ui) {

            var id = ui.draggable.find('.atividade').attr('atv-id')

            var itemDrop = document.createElement('div')

            $.post(baseUrl, {
                id: id,
                status: 0
            }, function(data) {


                $(itemDrop)
                    .append(data)
                    .addClass('kanban-item')
                    .draggable({
                        revert: "invalid"
                    })
                    .find('.view')
                    .removeClass('verde amarelo vermelho branco')
                    .addClass('amarelo')
            }).complete(
                function() {
                    registerActivityListeners()
                    console.log('\nAtividade ' + id + ' salva na aba TODDO.')
                })

            $(this).append(itemDrop)

            ui.draggable.fadeOut(100)


            //Dispara as mudanças
            sendUpdates()
        }

        function savePasso() {
            var id = $(this).attr('id')
            $.post('/sipesq/index.php/atividade/passoConcluido/' + id, {
                finalizado: this.checked
            })
            console.log('Passo ' + id + ' salvo com: ' + (this.checked ? 'true' : 'false'))
            $(this).parent('.status').addClass('ui-icon ui-icon-check')

            //Dispara as mudanças
            sendUpdates()


        }


        function Kanban.prototype.registerActivityListeners() {
            $('.ok-button').unbind('click').click(savePasso)


            $('.drop-button').unbind('toggle').toggle(
                function() {
                    $(this).parent().find('.atv-passos').removeClass('hidden')
                    $(this).removeClass('ui-icon-circle-triangle-e').addClass('ui-icon-circle-triangle-s')
                },
                function() {
                    $(this).parent().find('.atv-passos').addClass('hidden')
                    $(this).removeClass('ui-icon-circle-triangle-s').addClass('ui-icon-circle-triangle-e')

                }

            )

        }


        function Kanban.prototype.fillPage(options) {

            async.series([

                    function(callback) {

                        async.parallel([

                            function(callback) {
                                loadActivity('#atv-list-todo', 0, options)
                                callback(null, 'Todo done')

                            },
                            function(callback) {
                                loadActivity('#atv-list-today', 1, options)
                                callback(null, 'Today done')
                            },
                            function(callback) {
                                loadActivity('#atv-list-done', 2, options)
                                callback(null, 'Done done')

                            }

                        ], function(err, results) {

                            $.each(results, function(key, value) {
                                console.log(value)
                            })

                            initKanban()

                            setTimeout(initKanban, 2000)

                        })

                        callback(null, 'Colunas carregadas')

                    }, //primeria funcao do series

                    function(callback) {

                        //initKanban()
                        callback(null, 'Kanban Iniciado')

                    }
                ],

                function(err, results) {

                    $.each(results, function(key, value) {
                        console.log(value)
                    })

                })


        }




        /**
         * Carrega as atividades
         * @param containerId - wrapper onde serão carregadas as atividades
         * @param status - Quais atividades vao ser carragadas (todo, today, done)
         * @param options - opções como pessooa, projeto e categoria de atividades
         */
        function Kanban.prototype.loadActivity(containerId, status, options) {
            $.post('/sipesq/index.php/atividade/loadColumn', {
                    options: options,
                    status: status

                },

                function(data) {
                    $(containerId).html(data)
                    initKanban()
                }
            )
        }

        /**
         * Divulga via broadcast as mudanças feitas
         */

    Kanban.prototype.sendUpdates() {
        //Divulga as mudanças


        socket = io && io.connect('http://143.54.64.214:8000')
        socket.emit('activityUpdated')

    }

    exports.init = initKanban

})(window.Kanban)