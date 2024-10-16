<!--  Script Referentiel Banques  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getBanques",
            urlPOST: "API/api_pgav.php?action=postBanque",
            urlUPDATE: "API/api_pgav.php?action=updateBanque",
            urlDELETE: "API/api_pgav.php?action=deleteBanque",
            banques: [],
            newBanque: {},
            currentBanque: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllBanques();

        },
        methods: {
            getAllBanques() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.banques = resultat.banques;

                        }

                    })
            },
          
            addBanque() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newBanque);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newBanque = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllBanques();
                        }
                    })


            },
            updateBanque() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentBanque);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentBanque = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllBanques();
                        }
                    })


            },

            deleteBanque() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentBanque);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentBanque = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllBanques();
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
            selectedBanque(banque) {
                this.currentBanque = banque;
            }


        }


    }).$mount('#app')
</script>