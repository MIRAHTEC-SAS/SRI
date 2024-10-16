<!--  Script Referentiel Hierarchies  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetMinisteres: "API/api_pgav.php?action=getMinistere",
            urlGetDg: "API/api_pgav.php?action=getDirectionsGenerales",
            urlGetCorps: "API/api_pgav.php?action=getCorps",
            urlGetSm: "API/api_pgav.php?action=getSm",
            urlGetBaremes: "API/api_pgav.php?action=getBaremes",
            urlGetReductions: "API/api_pgav.php?action=getReductions",
            urlGetAgences: "API/api_pgav.php?action=getAgences",
            urlGetHierarchies: "API/api_pgav.php?action=getHierarchies",
            urlGetBanques: "API/api_pgav.php?action=getBanques",
            urlGetDirections: "API/api_pgav.php?action=getDirections",
            urlGetFc: "API/api_pgav.php?action=getFc",
            urlGetAgents: "API/api_pgav.php?action=getAgents",
            urlPOST: "API/api_pgav.php?action=postHierarchie",
            urlUPDATE: "API/api_pgav.php?action=updateHierarchie",
            urlDELETE: "API/api_pgav.php?action=deleteHierarchie",
            hierarchies: [],
            ministeres:[],
            directionsGenerales:[],
            directions:[],
            fcs:[],
            agences: [],
            banques: [],
            reductions:[],
            agents:[],
            baremes:[],
            situations_m:[],
            corps:[],
            newHierarchie: {},
            newFcInit:{},
            currentHierarchie: {},
            currentAgent:{}
        },
        computed: {
            fcParMinistere() {
                return this.fcs.filter(fc => fc.codeMinistere === this.newFcInit.codeMinistere);
            },
            agentsParMinistere() {
                return this.agents.filter(agent => agent.codeMinistere === this.newFcInit.codeMinistere);
            },
            selectedMinistere() {
                return this.ministeres.filter(ministere => ministere.codeMinistere === this.newFcInit.codeMinistere);
            },
            selectedFc() {
                return this.fcs.filter(fc => fc.codeFc === this.newFcInit.codeFc);
            },
            dgParMinistere() {
                return this.directionsGenerales.filter(dg => dg.codeMinistere === this.newFcInit.codeMinistere);
            },
            directionsParDg() {
                return this.directions.filter(d => d.codeDirectionGenerale === this.newFcInit.codeDirectionGenerale);
            },
            agentsParDg() {
                return this.agents.filter(agent => agent.codeDirectionGenerale === this.newFcInit.codeDirectionGenerale);
            },
            agentsParDirection() {
                return this.agents.filter(agent => agent.codeDirection === this.newFcInit.codeDirection);
            },
            agencesParBanque() {
                return this.agences.filter(agence => agence.codeBanque === this.currentAgent.codeBanque);
            },
            newPart() {
                switch (this.currentAgent.situation_matrimoniale) {
                    case 'Célibataire' :
                        if (this.currentAgent.nb_enfant==0) return 1;
                        if (this.currentAgent.nb_enfant==1) return 1.5;
                        if (this.currentAgent.nb_enfant==2) return 2.5;
                        if (this.currentAgent.nb_enfant==3) return 2.5;
                        if (this.currentAgent.nb_enfant==4) return 3;

                    break;
                    case 'Marié' :
                        if (this.currentAgent.nb_enfant==0) return 1.5;
                        if (this.currentAgent.nb_enfant==1) return 2;
                        if (this.currentAgent.nb_enfant==2) return 2.5;
                        if (this.currentAgent.nb_enfant==3) return 3;
                        if (this.currentAgent.nb_enfant==4) return 3;
                    break;
                    case 'Divorcé' :
                        if (this.currentAgent.nb_enfant==0) return 1;
                        if (this.currentAgent.nb_enfant==1) return 1.5;
                        if (this.currentAgent.nb_enfant==2) return 2;
                        if (this.currentAgent.nb_enfant==3) return 2.5;
                        if (this.currentAgent.nb_enfant==4) return 3;
                    break;
                    case 'Veuf' :
                        if (this.currentAgent.nb_enfant==0) return 1;
                        if (this.currentAgent.nb_enfant==1) return 1.5;
                        if (this.currentAgent.nb_enfant==2) return 2;
                        if (this.currentAgent.nb_enfant==3) return 2.5;
                        if (this.currentAgent.nb_enfant==4) return 3;
                    break;
                }
            },
            newTaux() {
                switch (this.currentAgent.codeBareme) {
                    case 'B1' : return 0; break;
                    case 'B2' : return 0.2; break;
                    case 'B3' : return 0.3; break;
                    case 'B4' : return 0.35; break;
                    case 'B5' : return 0.37; break;
                    case 'B6' : return 0.4; break;


                }
            },
            // newTauxReduit() {
            //     if (this.newPart==1) return 0;
            // }
            newTauxReduit() {
                switch (this.newPart) {
                    case 1 : return 0; break;
                    case 1.5 : return 0.1; break;
                    case 2 : return 0.15; break;
                    case 2.5 : return 0.2; break;
                    case 3 : return 0.25; break;
                    case 3.5 : return 0.3; break;
                    case 4 : return 0.34; break;

                }
            },
            newPartHierarchie() {
                switch (this.currentAgent.hierarchie) {
                    case 'A' : return 5; break;
                    case 'B' : return 4; break;
                    case 'C' : return 3; break;
                    case 'D' : return 3; break;
                   

                }
            }
        },
        mounted() {
            this.getAllDg();
            this.getAllHierarchies();
            this.getAllMinisteres();
            this.getAllFc();
            this.getAllAgents();
            this.getAllCorps();
            this.getAllDirections();
            this.getAllSm();
            this.getAllAgences();
            this.getAllBanques();
            this.getAllBaremes();
            this.getAllReductions();



        },
        methods: {
            getAllCorps() {
                axios.get(this.urlGetCorps)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.corps = resultat.corps;

                        }

                    })
            },
            getAllReductions() {
                axios.get(this.urlGetReductions)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.reductions = resultat.reductions;

                        }

                    })
            },
            getAllBaremes() {
                axios.get(this.urlGetBaremes)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.baremes = resultat.baremes;

                        }

                    })
            },
            getAllAgences() {
                axios.get(this.urlGetAgences)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.agences = resultat.agences;

                        }

                    })
            },
            getAllBanques() {
                axios.get(this.urlGetBanques)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.banques = resultat.banques;

                        }

                    })
            },
            getAllSm() {
                axios.get(this.urlGetSm)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.situations_m = resultat.situations_m;

                        }

                    })
            },
            getAllHierarchies() {
                axios.get(this.urlGetHierarchies)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.hierarchies = resultat.hierarchies;

                        }

                    })
            },
            getAllFc() {
                axios.get(this.urlGetFc)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.fcs = resultat.fcs;

                        }

                    })
            },
            getAllDg() {
                axios.get(this.urlGetDg)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directionsGenerales = resultat.directionsGenerales;

                        }

                    })
            },
            getAllDirections() {
                axios.get(this.urlGetDirections)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directions = resultat.directions;

                        }

                    })
            },
            getAllAgents() {
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
            getAllMinisteres() {
                axios.get(this.urlGetMinisteres)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.ministeres = resultat.ministeres;

                        }

                    })
            },
          
            addHierarchie() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newHierarchie = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
                        }
                    })


            },
            updateHierarchie() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentHierarchie = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
                        }
                    })


            },

            deleteHierarchie() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentHierarchie = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
                        }
                    })


            },

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
            selectedHierarchie(hierarchie) {
                this.currentHierarchie = hierarchie;
            },

              // Methode pour recuperer le periodes selectionné 
              selectedAgent(agent) {
                this.currentAgent = agent;
            }


        }


    }).$mount('#app')
</script>