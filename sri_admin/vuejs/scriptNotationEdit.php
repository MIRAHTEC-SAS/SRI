<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetAgents: "API/api_pgav.php?action=getAgentNotees",
            urlGetDecades: "API/api_pgav.php?action=getDecades",
            urlGetNotes: "API/api_pgav.php?action=getNotes",
            urlUpdateNote: "API/api_pgav.php?action=updateNote",
            urlGetUser: "API/api_pgav.php?action=getUsers",
            agents : [],
            decades: [],
            notes: [],
            currentUser:[],
            currentAgent: {}
        },
        computed: {
            agentsCurrentDirection() {
                return this.agents.filter(agent => agent.codeDirection === this.currentUser.codeDirection);
            },
            nbCoef5() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="5");
            },
            nbCoef4() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="4");
            },
            nbCoef0() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="0");
            },
            nbCoef1() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="1");
            },
            nbCoef2() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="2");
            },
            nbCoef3() {
                return this.agentsCurrentDirection.filter(agent => agent.note==="3");
            },

            nbNotes5() {
                return this.nbCoef5.length;
            },
            nbNotes4() {
                return this.nbCoef4.length;
            },
            nbNotes1() {
                return this.nbCoef1.length;
            },
            nbNotes0() {
                return this.nbCoef0.length;
            },
            nbNotes2() {
                return this.nbCoef2.length;
            },
            nbNotes3() {
                return this.nbCoef3.length;
            },
            effectifService() {
                return this.agentsCurrentDirection.length;
            },
            pourcentageNote5() {
                var p = ((parseInt(this.nbNotes5))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote4() {
                var p = ((parseInt(this.nbNotes4))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote0() {
                var p = ((parseInt(this.nbNotes0))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote1() {
                var p = ((parseInt(this.nbNotes1))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote2() {
                var p = ((parseInt(this.nbNotes2))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote3() {
                var p = ((parseInt(this.nbNotes3))/(parseInt(this.effectifService)))*100;
                // return p.toFixed(1);
                return Math.round(p,2);
            },
            pourcentageNote4et5() {
                return parseInt(this.pourcentageNote5)+parseInt(this.pourcentageNote4);
            },
            pourcentageNote0et1() {
                return parseInt(this.pourcentageNote0)+parseInt(this.pourcentageNote1);
            },

        },
        mounted() {
            this.getAgents();
            this.getDecades();
            this.getUser();
            this.getNotes();
        },
        methods: {
           
            getAgents() {
                axios.get(this.urlGetAgents)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.agents = resultat.agents;

                        }

                    })
            },
            

            getDecades() {
                axios.get(this.urlGetDecades)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.decades = resultat.decades;

                        }

                    })
            },
            
            getUser() {
                axios.get(this.urlGetUser)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.currentUser = resultat.currentUser;

                        }

                    })
            },
            getNotes() {
                axios.get(this.urlGetNotes)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.notes = resultat.notes;

                        }

                    })
            },
            
            getUser() {
                axios.get(this.urlGetUser)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.currentUser = resultat.currentUser;

                        }

                    })
            },

            updateNote() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentAgent);

                //On lance la requete GET (Create)
                axios.post(this.urlUpdateNote, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentAgent = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this. this.getAgents();
                        }
                    })


            },
            
          
            // addCorps() {

            //     // On prepare le form pour insertion les champs dans le variable global POST
            //     var formData = this.toFormData(this.newCorps);

            //     //On lance la requete POST (Create)
            //     axios.post(this.urlPOST, formData)
            //         .then((resultat) => resultat.data)
            //         .then((resultat) => {
            //             this.newCorps = {
            //             }
            //             if (resultat.error) {
            //                 this.errorMsg = resultat.error;
            //             } else {
            //                 this.hideMsg();
            //                 this.successMsg = resultat.message;
            //                 this.getAllCorps();
            //             }
            //         })


            // },


            // deleteCorps() {
            //     // On prepare le form pour insertion les champs dans le variable global POST
            //     var formData = this.toFormData(this.currentCorps);

            //     //On lance la requete GET (Create)
            //     axios.post(this.urlDELETE, formData)
            //         .then((resultat) => resultat.data)
            //         .then((resultat) => {
            //             this.currentCorps = {};
            //             if (resultat.error) {
            //                 this.errorMsg = resultat.message
            //             } else {
            //                 this.successMsg = resultat.message;
            //                 this.getAllCorps();
            //             }
            //         })


            // },

            hideMsg() {
                this.errorMsg = false,
                    this.successMsg = false
            },

            toFormData(obj) {
                var fd = new FormData();
                for (var i in obj) {
                    fd.append(i, obj[i]);
                }

                return fd;
            },
            // Methode pour recuperer le periodes selectionné 
            selectedAgent(agent) {
                this.currentAgent = agent;
            }


        }


    }).$mount('#app')
</script>
