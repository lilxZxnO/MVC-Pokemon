const selectedPokemons = [];

const fetchPokemon = async (query) => {
    try {
        const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${query.toLowerCase()}`);
        if (!response.ok) {
            throw new Error('Pokémon non trouvé');
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
        return null;
    }
};

const fetchPokemonType = async (type) => {
    const buttons = document.querySelectorAll('.type');
    buttons.forEach((button) => button.classList.remove('active'));
    const texts = document.querySelectorAll('.type p');
    texts.forEach((text) => text.classList.add('text-zinc-300'));
    const button = document.querySelector(`.type img[alt="${type}"]`).parentNode;
    button.classList.add('active');
    const text = button.querySelector('p');
    text.classList.remove('text-zinc-300');

    try {
        const response = await fetch(`https://pokeapi.co/api/v2/type/${type}`);
        if (!response.ok) {
            throw new Error('Type non trouvé');
        }
        const data = await response.json();
        const pokemonList = data.pokemon.map((poke) => poke.pokemon);
        displayPokemon(pokemonList);
    } catch (error) {
        console.error(error);
    }
}

const fetchPokemonList = async (limit = 12, offset = 0) => {
    try {
        const response = await fetch(`https://pokeapi.co/api/v2/pokemon?limit=${limit}&offset=${offset}`);
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error(error);
        return [];
    }
};

const colorTypes = {
    all: '#3F5DB3',
    bug: '#A8B820',
    dark: '#705848',
    dragon: '#7038F8',
    electric: '#F8D030',
    fairy: '#EE99AC',
    fighting: '#C03028',
    fire: '#F08030',
    flying: '#A890F0',
    ghost: '#705898',
    grass: '#78C850',
    ground: '#E0C068',
    ice: '#98D8D8',
    normal: '#A8A878',
    poison: '#A040A0',
    psychic: '#F85888',
    rock: '#B8A038',
    steel: '#B8B8D0',
    water: '#6890F0',
};

function idFill(id) {
    id = id.toString();
    if (id.length === 1) {
        return `#00${id}`;
    }
    if (id.length === 2) {
        return `#0${id}`;
    }
    return `#${id}`;
}

const displayPokemon = (pokemon) => {
    const resultContainer = document.querySelector('.result-search');
    resultContainer.innerHTML = ''; // Efface les résultats précédents
    const numberPokemon = document.querySelector('#number-pokemons');
    numberPokemon.innerHTML = pokemon.length;

    if (pokemon) {
        if (Array.isArray(pokemon)) {
            pokemon.forEach(async (poke) => {
                const details = await fetchPokemon(poke.name);

                // Ajout d'un ID unique pour chaque carte de Pokémon pour faciliter la gestion de la sélection
                const pokemonHTML = `
                  <div class="pokemon-card cursor-pointer bg-white rounded-lg" id="pokemon-${details.id}">
                    <div class="bg m-auto relative size-[180px] flex items-center justify-center after:content-[''] after:absolute after:inset-0 after:rounded-full after:bg-[${colorTypes[details.types[0].type.name]}]/20 after:z-50"
                    > 
                      <img src="${details.sprites.other.dream_world.front_default}" alt="${details.name}" class="size-[200px] mx-auto z-[100]" />
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                    <p class="text-zinc-500">
                        ${idFill(details.id)}
                    </p>
                    <h3 class="text-xl font-bold capitalize">${details.name}</h3>
                    </div>
                    <div class="flex gap-2">
                    ${details.types.map((type) => `
                    <img class="size-5" src="./public/assets/icons/icon-types/${type.type.name}.svg" alt="${type.type.name}" class="size-[50px] mx-auto" />
                    `).join('')}
                    </div>
                    </div>
                    <button type="button" class="select-pokemon bg-blue-500 text-white py-1 px-4 rounded" data-pokemon-name="${details.name}">Sélectionner</button>
                  </div>
                `;
                resultContainer.style.display = 'grid';
                resultContainer.innerHTML += pokemonHTML;
            });
        } else {
            const pokemonHTML = `
            <div class="pokemon-card cursor-pointer bg-white rounded-lg">
            <div class="bg m-auto relative size-[180px] after:-z-10 flex items-center justify-center after:content-[''] after:absolute after:inset-0 after:rounded-full after:bg-[${colorTypes[pokemon.types[0].type.name]}]/20"
            > 
                <img src="${pokemon.sprites.other.dream_world.front_default}" alt="${pokemon.name}" class="size-[200px] mx-auto z-[100]" />
            </div>
            <div class="flex items-center justify-between">
            <div>
            <h3 class="text-xl font-bold text-center capitalize">${pokemon.name}</h3>
            <p class="text-zinc-500">
                ${idFill(pokemon.id)}
            </p>
            </div>
            <div class="flex gap-2">
            <img class="size-5" src="./public/assets/icons/icon-types/${pokemon.types[0].type.name}.svg" alt="${pokemon.types[0].type.name}" class="size-[50px] mx-auto" />
            <img class="size-5" src="./public/assets/icons/icon-types/${pokemon.types[1]?.type.name}.svg" alt="${pokemon.types[1]?.type.name}" class="size-[50px] mx-auto" />
            </div>
            </div>
            <button type="button" class="select-pokemon bg-blue-500 text-white py-1 px-4 rounded" data-pokemon-name="${pokemon.name}">Sélectionner</button>
            </div>
            `;
            resultContainer.style.display = 'grid';
            resultContainer.innerHTML = pokemonHTML;
        }
    } else {
        resultContainer.style.display = 'block';
        resultContainer.innerHTML = '<p class="text-center font-bold text-xl text-red-500">Pokémon non trouvé. Essayez un autre nom </p>';
    }
};

const loadInitialPokemon = async () => {
    const pokemonList = await fetchPokemonList();
    displayPokemon(pokemonList);
};


document.querySelector('#default-search').addEventListener('input', async (event) => {
    const query = event.target.value.trim();
    if (query.length > 0) {
        const pokemon = await fetchPokemon(query);
        displayPokemon(pokemon);
    } else {
        loadInitialPokemon(); // Charge la liste initiale si la barre est vide
    }
});

document.querySelector('.result-search').addEventListener('click', async (event) => {
    if (event.target.id === 'load-all-pokemons') {
        const allPokemonList = await fetchPokemonList(150); // Exemple : charger les 150 premiers Pokémon
        displayPokemon(allPokemonList);
    }
});

loadInitialPokemon();

function renderAllTypesButton() {
    const container = document.getElementById('types-container');
    const types = ['all', 'normal', 'fire', 'water', 'electric', 'grass', 'ice', 'fighting', 'poison', 'ground', 'flying', 'psychic', 'bug', 'rock', 'ghost', 'dark', 'dragon', 'steel', 'fairy'];

    types.forEach((type) => {
        const buttonHTML = `
            <div
                class="type flex items-center gap-3 cursor-pointer"
                onclick="fetchPokemonType('${type}')"
            >
                <img class="grayscale" src="./public/assets/icons/icon-types/${type}.svg" alt="${type}" />
                <p class="text-sm text-[${colorTypes[type]}] text-zinc-300 font-medium capitalize">${type}</p>
            </div>
        `;
        container.innerHTML += buttonHTML;
    });

    const allButton = document.querySelector('.type img[alt="all"]').parentNode;
    allButton.classList.add('active');
    const text = allButton.querySelector('p');
    text.classList.remove('text-zinc-300');
}

renderAllTypesButton(); 

const updateSubmitButtonVisibility = () => {
    const submitButton = document.querySelector('#submit-selection');
    // Si 2 Pokémon sont sélectionnés, on rend le bouton visible
    if (selectedPokemons.length === 2) {
        submitButton.classList.remove('opacity-0', 'pointer-events-none');
        submitButton.classList.add('opacity-100', 'pointer-events-auto');

        // Met à jour les valeurs des champs cachés
        document.getElementById('pokemon1').value = selectedPokemons[0];
        document.getElementById('pokemon2').value = selectedPokemons[1];
        console.log(selectedPokemons);
    } else {
        submitButton.classList.add('opacity-0', 'pointer-events-none');
        submitButton.classList.remove('opacity-100', 'pointer-events-auto');
    }
};

document.querySelector('.result-search').addEventListener('click', (event) => {
    if (event.target.classList.contains('select-pokemon')) {
        const pokemonId = event.target.getAttribute('data-pokemon-name');

        const index = selectedPokemons.indexOf(pokemonId);
        if (index > -1) {
            selectedPokemons.splice(index, 1);
            event.target.classList.remove('bg-green-500');
            event.target.innerText = 'Sélectionner';
        } else {
            if (selectedPokemons.length < 2) {
                selectedPokemons.push(pokemonId);
                event.target.classList.add('bg-green-500');
                event.target.innerText = 'Désélectionner';
            } else {
                alert('Vous pouvez sélectionner un maximum de 2 Pokémon');
            }
        }

        // Mise à jour de la visibilité du bouton
        updateSubmitButtonVisibility();
    }
});

