<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetCandidats: "API/api_cfj.php?action=getCandidatsPlanifies",
            urlGetConcours: "API/api_cfj.php?action=getConcours",
            urlGetConcoursInit: "API/api_cfj.php?action=getConcoursInit",
            urlGetConcoursInitSalles: "API/api_cfj.php?action=getConcoursInitSalles",
            urlGetCentres: "API/api_cfj.php?action=getCentres",
            urlGetSalles: "API/api_cfj.php?action=getSalles",
            urlGetSallesInit: "API/api_cfj.php?action=getSalles",
            urlGetResponsables: "API/api_cfj.php?action=getResponsables",
            urlGetSurveillants: "API/api_cfj.php?action=getSurveillants",
            urlGetJury: "API/api_cfj.php?action=getJury",
            urlGetHeures: "API/api_cfj.php?action=getHeures",
            urlGetCandidatsListes: "API/api_cfj.php?action=getCandidatsListes",
            urlGetListes: "API/api_cfj.php?action=getListes",
            urlGetChoixSms: "API/api_cfj.php?action=getChoixSms",
            urlPostSms: "sms/sms_alpha.php?action=postSms",
            candidats: [],
            candidatsListes: [],
            concours:[],
            surveillants:[],
            concoursInit:[],
            concoursInitSalles:[],
            sallesInit:[],
            heures:[],
            centres:[],
            salles:[],
            salles2:[],
            selectedSalles:[],
            responsables:[],
            jury:[],
            listes:[],
            choixSms:[],
            capacite:{},
            
            // secteurs:[],
            newSms: {},
            newPlanif: {},
            // currentCorps: {}
        },
        computed: {
            selectedConcours() {
                return this.concours.filter(c => c.codeConcours === this.newPlanif.codeConcours);
            },
            selectedConcoursInit() {
                return this.concoursInit.filter(c => c.codeConcours === this.newPlanif.codeConcours);
            },
            selectedConcoursInitSalles() {
                return this.concoursInitSalles.filter(c => c.codeConcours === this.newPlanif.codeConcours);
            },
            selectedCentre() {
                return this.centres.filter(c => c.codeCentre === this.newPlanif.codeCentre);
            },
            selectedDate() {
                return this.newPlanif.dateConcours;
            },
            selectedDebut() {
                return this.newPlanif.debut;
            },
            selectedFin() {
                return this.newPlanif.fin;
            },
            selectedCandidats() {
                return this.candidats.filter(c => c.codeConcours === this.newPlanif.codeConcours);
            },
            sallesByCentre() {
                return this.salles.filter(s => s.codeCentre === this.newPlanif.codeCentre);
            },
     
            capaciteSalles() {
            //  22401    
            $c=0;
                 for ($i=0;$i<this.selectedSalles.length;$i++) {
                     $salle=this.selectedSalles[$i];
                     
                        for ($j=0;$j<this.salles.length;$j++) {
                            if (this.salles[$j].codeSalle===$salle) {
                                $c=$c+parseInt(this.salles[$j].capacite);
                            }
                        }
                } 
                return $c;
            },

            nbCandidats() {
                $nb=0;
                for ($i=0;$i<this.selectedCandidats.length;$i++) {
                    if (this.selectedCandidats[$i].codeConcours==this.newPlanif.codeConcours) {
                        $nb=$nb+1;
                    }
                }
                return $nb;
        },
        nbSallesSelected() {
                $nb=0;
                for ($i=0;$i<this.selectedSalles.length;$i++) {
                  $nb=$nb+1;
                }
                return $nb;
        },

            
        },
        mounted() {
            this.getAllCandidats();
            this.getAllCandidatsListes();
            this.getAllListes();
            this.getAllChoixSms();
            this.getAllConcours();
            this.getAllConcoursInit();
            this.getAllConcoursInitSalles();
            this.getAllSallesInit();
            this.getAllHeures();
            this.getAllCentres();
            this.getAllSalles();
            this.getAllResponsables();
            this.getAllJury();
            this.getAllSurveillants();
            // this.getAllSecteurs();

        },
        methods: {
            getAllCandidats() {
                axios.get(this.urlGetCandidats)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.candidats = resultat.candidats;

                        }

                    })
            },
            getAllSurveillants() {
                axios.get(this.urlGetSurveillants)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.surveillants = resultat.surveillants;

                        }

                    })
            },
            getAllConcours() {
                axios.get(this.urlGetConcours)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.concours = resultat.concours;

                        }

                    })
            },
            getAllConcoursInit() {
                axios.get(this.urlGetConcoursInit)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.concoursInit = resultat.concoursInit;

                        }

                    })
            },
            getAllConcoursInitSalles() {
                axios.get(this.urlGetConcoursInitSalles)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.concoursInitSalles = resultat.concoursInitSalles;

                        }

                    })
            },
            getAllHeures() {
                axios.get(this.urlGetHeures)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.heures = resultat.heures;

                        }

                    })
            },
            getAllCentres() {
                axios.get(this.urlGetCentres)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.centres = resultat.centres;

                        }

                    })
            },
            getAllSalles() {
                axios.get(this.urlGetSalles)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.salles = resultat.salles;

                        }

                    })
            },
            getAllSallesInit() {
                axios.get(this.urlGetSallesInit)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.sallesInit = resultat.sallesInit;

                        }

                    })
            },
            getAllResponsables() {
                axios.get(this.urlGetResponsables)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.responsables = resultat.responsables;

                        }

                    })
            },
            getAllJury() {
                axios.get(this.urlGetJury)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.jury = resultat.jury;

                        }

                    })
            },
            getAllCandidatsListes() {
                axios.get(this.urlGetCandidatsListes)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.candidatsListes = resultat.candidatsListes;

                        }

                    })
            },
            addPlanif() {
                        axios({
                            method: 'post',
                            url: 'controllers/gestionConcours.php?action=createParam',
                            data: {
                                concoursPlanif: json_encode(this.concoursInitSalles)
                                }
                            });
                        },

            getAllListes() {
                axios.get(this.urlGetListes)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.listes = resultat.listes;

                        }

                    })
            },
            getAllChoixSms() {
                axios.get(this.urlGetChoixSms)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.choixSms = resultat.choixSms;

                        }

                    })
            },

            addCours() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newCours);

                //On lance la requete GET (Create)
                axios.post(this.urlCreate, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newCours = {
                            nom_cours: "",
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllCours();
                        }
                    })


                },
         
          
            addSms() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newSms);

                //On lance la requete POST (Create)
                axios.post(this.urlPostSms, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newSms = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllCandidats();
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
            selectedCorps(sms) {
                this.currentSms = sms;
            }


        }


    }).$mount('#app')
</script>