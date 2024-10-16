<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetCandidats: "API/api_cfj.php?action=getCandidats",
            urlGetCandidatsListes: "API/api_cfj.php?action=getCandidatsListes",
            urlGetListes: "API/api_cfj.php?action=getListes",
            urlGetChoixSms: "API/api_cfj.php?action=getChoixSms",
            urlPostSms: "sms/sms_alpha.php?action=postSms",
            candidats: [],
            candidatsListes: [],
            searchKey:{},
            listes:[],
            choixSms:[],
            // secteurs:[],
            newSms: {},
            // currentCorps: {}
        },
        computed: {
            selectedCandidat() {
                return this.candidats.filter(candidat => candidat.matricule === this.newSms.candidat);
            },
            rechercheCandidat() {
                    return this.candidats.filter(candidat => candidat.nom === this.searchKey.key);
            },
            selectedCandidats() {
                return this.candidatsListes.filter(candidatListe => candidatListe.id_liste === this.newSms. liste);
            },

            
        },
        mounted() {
            this.getAllCandidats();
            this.getAllCandidatsListes();
            this.getAllListes();
            this.getAllChoixSms();
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