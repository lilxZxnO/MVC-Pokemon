// Variables pour stocker les Pokémon sélectionnés
const selectedPokemons = [];

// Fonction pour créer une carte Pokémon
function createPokemonCard(pokemon) {
    const card = document.createElement("div");
    card.classList.add(
        "pokemon-card",
        "flex",
        "flex-col",
        "items-center",
        "bg-white",
        "rounded-lg",
        "cursor-pointer"
    );
    card.dataset.id = pokemon.id; // Stocker l'ID du Pokémon

    card.innerHTML = `
    <img
      src="${pokemon.image}"
      alt="${pokemon.name}"
      class="w-20 h-20 object-cover"
    />
    <p class="text-lg font-bold">${pokemon.name}</p>
  `;

    // Gestion de clic pour sélectionner un Pokémon
    card.addEventListener("click", () => handlePokemonSelection(card, pokemon));

    return card;
}

// Fonction de gestion de la sélection de Pokémon
function handlePokemonSelection(card, pokemon) {
    const index = selectedPokemons.findIndex((p) => p.id === pokemon.id);

    if (index !== -1) {
        // Si le Pokémon est déjà sélectionné, le désélectionner
        selectedPokemons.splice(index, 1);
        card.classList.remove("active", "border-4", "border-blue-500");
    } else if (selectedPokemons.length < 2) {
        // Sinon, sélectionner le Pokémon (limite à 2)
        selectedPokemons.push(pokemon);
        card.classList.add("active", "border-4", "border-blue-500");
    }

    // Mise à jour du bouton de confirmation
    updateConfirmButton();
}

// Fonction pour mettre à jour le bouton de confirmation
function updateConfirmButton() {
    const confirmButton = document.getElementById("confirm-button");
    confirmButton.disabled = selectedPokemons.length !== 2;
}

// Fonction de confirmation
function confirmSelection() {
    if (selectedPokemons.length === 2) {
        // Redirection ou traitement après confirmation
        const queryParams = selectedPokemons.map((p) => `pokemon=${p.id}`).join("&");
        window.location.href = `fight.html?${queryParams}`;
    }
}

// Fetch des Pokémon et affichage
async function fetchPokemons() {
    const container = document.querySelector(".result-search");
    const response = await fetch("https://pokeapi.co/api/v2/pokemon?limit=30");
    const data = await response.json();

    data.results.forEach((pokemon, index) => {
        const pokemonData = {
            id: index + 1, // Utiliser un ID fictif pour la démo
            name: pokemon.name,
            image: `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${index + 1}.png`,
        };

        const card = createPokemonCard(pokemonData);
        container.appendChild(card);
    });
}

// Initialisation
document.addEventListener("DOMContentLoaded", () => {
    fetchPokemons();

    // Ajouter un écouteur pour le bouton de confirmation
    const confirmButton = document.getElementById("confirm-button");
    confirmButton.addEventListener("click", confirmSelection);
});
