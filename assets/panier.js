document.querySelectorAll('.ajoutJeu').forEach(function(button) {
    button.addEventListener('click', function() {
        // Récupération des données du jeu
        let id = button.getAttribute('data-id');
        let nom = button.getAttribute('data-nom');
        let prix = button.getAttribute('data-prix');

        // Ajout du jeu au panier
        ajouterJeu(id, nom, prix);
    });
});

function ajouterJeu(id, nom, prix) {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Vérification si le jeu est déjà dans le panier
    let jeu = panier.find(j => j.id == id);
    if (jeu) {
        jeu.quantite++;
    } else {
        panier.push({ id: id, nom: nom, prix: prix, quantite: 1 });
    }

    // Enregistrement du panier
    localStorage.setItem('panier', JSON.stringify(panier));
}

// dans panier.js
document.addEventListener('DOMContentLoaded', function() {
    // Récupération du panier
    // détecter si un élément avec l'id panier existe, si oui appeler la fonction afficherPanier
    if (document.getElementById('panier')) {
        afficherPanier();
        document.querySelector('#viderPanier').addEventListener('click', function(event) {
            console.log("click");
            localStorage.removeItem('panier');
            afficherPanier();
        });
    }
});


function afficherPanier() {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Affichage du panier
    let panierElement = document.getElementById('panier');
    panierElement.innerHTML = '';
    let total = 0;
    panier.forEach(function(jeu) {
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${jeu.nom}</td>
            <td>${jeu.prix} €</td>
            <td>
            <select class="changeQuantite" data-id="${jeu.id}">
                <option value="1" ${jeu.quantite == 1 ? 'selected' : ''}>1</option>
                <option value="2" ${jeu.quantite == 2 ? 'selected' : ''}>2</option>
                <option value="3" ${jeu.quantite == 3 ? 'selected' : ''}>3</option>
                <option value="4" ${jeu.quantite == 4 ? 'selected' : ''}>4</option>
                <option value="5" ${jeu.quantite == 5 ? 'selected' : ''}>5</option>
                <option value="6" ${jeu.quantite == 6 ? 'selected' : ''}>6</option>
                <option value="7" ${jeu.quantite == 7 ? 'selected' : ''}>7</option>
                <option value="8" ${jeu.quantite == 8 ? 'selected' : ''}>8</option>
                <option value="9" ${jeu.quantite == 9 ? 'selected' : ''}>9</option>
                <option value="10" ${jeu.quantite == 10 ? 'selected' : ''}>10</option>
                </select>
           </td>
            <td>${jeu.prix * jeu.quantite} €</td>
            <td class="supprimerJeu" data-id="${jeu.id}">Supprimer</td>
        `;
        total += jeu.prix * jeu.quantite;
        panierElement.appendChild(tr);
    });

    let tr = document.createElement('tr');
    tr.innerHTML = `
    <td colspan="3" style="text-align: right">Prix total</td>
    <td>${total} €</td>
    <td></td>
    `;
    panierElement.appendChild(tr);




    document.querySelectorAll('.supprimerJeu').forEach(function(button) {
        button.addEventListener('click', function() {
            supprimerJeu(button.dataset.id)
        })
    })

    document.querySelectorAll('.changeQuantite').forEach(function(button) {
        button.addEventListener('change', function() {
            modifierQuantite(button.dataset.id, button.value)
        })
    })
}

function modifierQuantite(id, quantite) {
    let panier = JSON.parse(localStorage.getItem('panier')) || [];
    let jeu = panier.find(j => j.id == id);
    jeu.quantite = quantite;
    localStorage.setItem('panier', JSON.stringify(panier));
    afficherPanier();
}


function supprimerJeu(id) {
    if (confirm('Supprimer ce jeu du panier ?')) {
        let panier = JSON.parse(localStorage.getItem('panier')) || [];
        panier = panier.filter(jeu => jeu.id != id);
        localStorage.setItem('panier', JSON.stringify(panier));
        afficherPanier();
    }
}
