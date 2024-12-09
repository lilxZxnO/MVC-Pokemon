<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Project Pokemon | Pokemon Fight</title>
  <link rel="shortcut icon" href="./public/assets/icons/favicon.svg" type="image/x-icon" />
  <style>
    @keyframes translation {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .pokeball {
      animation: translation 2s infinite;
    }

    header {
      background-image: url("./public/assets/img/bg-red.svg");
      background-size: cover;
      background-position: center;
    }

    .pokemon-card.selected {
      border: 4px solid #4caf50;
      /* Bordure verte */
      box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
      /* Légère ombre pour plus de visibilité */
    }

    h1 {
      line-height: 1.2;
    }

    .pokemon-card {
      box-shadow: 0px 10px 51px -5px rgba(183, 189, 193, 0.3);
      padding: 13px 40px 24px 40px;
      transition: all 0.3s;
    }

    .pokemon-card:hover {
      box-shadow: 0px 12px 40px -5px rgba(90, 96, 100, 0.3);
    }

    .active img {
      filter: grayscale(0);
    }

    .active p {
      filter: grayscale(0);
    }
  </style>
</head>

<body>
  <nav class="flex items-center justify-between absolute top-0 z-10 w-full py-6 px-4 lg:px-28">
    <img class="w-28 lg:w-44" src="./public/assets/img/logo.svg" alt="" />
    <p>
      <a href="./public/pages/login.html" class="text-white text-base">Case Study -> Code<span
          class="font-bold">Boost</span></a>
    </p>
  </nav>
  <header class="pt-[8rem] relative">
    <div class="tag m-auto bg-white rounded-full p-1 flex items-center gap-2 max-w-[11rem]">
      <div class="p-2 bg-red-700/20 rounded-full">
        <img src="./public/assets/img/bag-red.svg" alt="" />
      </div>
      <p class="text-red-700 font-bold text-md">pokemon fight</p>
    </div>

    <div class="flex flex-col items-center justify-center text-center mt-[2rem]">
      <h1 class="text-white line text-[3rem] md:text-[4.5rem] font-bold">
        Who is that Pokemon?
      </h1>
      <p class="text-white text-xl">
        The perfect game to fight with your favorite pokemons.
      </p>

      <div
        class="image z-10 h-[450px] relative m-auto max-w-[72rem] w-full pt-32 pokeball flex items-center justify-center">
        <img class="absolute top-20 right-1/2 translate-x-1/2" src="./public/assets/img/lighting.svg" alt="" />
        <img class="max-w-[72rem] absolute top-28" src="./public/assets/img/pokeball-red.png" alt="" />
      </div>
    </div>

    <div class="area-explore hidden md:block absolute bottom-8 lg:left-28">
      <div class="text-white -rotate-90 mb-10">explore</div>
      <div class="icon rounded-full p-2 bg-red-700 flex items-center justify-center size-14">
        <img src="./public/assets/icons/arrow-down.svg" alt="" />
      </div>
    </div>
  </header>

  <main>
    <div class="header bg-slate-100 flex justify-between items-center flex-col md:flex-row py-28 px-4 lg:px-28">
      <h2 class="font-bold text-4xl">Select your Pokemon</h2>

      <div class="search-bar">
        <form class="mx-auto" id="pokemon-form" method="POST">
          <label for="default-search"
            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
          <div class="relative">
            <div class="absolute inset-y-0 flex items-center ps-3 pointer-events-none">
              <img src="./public/assets/icons/icon-search.svg" alt="" />
            </div>
            <input type="search" id="default-search" class="rounded-full w-[300px] p-4 pl-12"
              placeholder="Search Pokemon" required />
          </div>
        </form>
      </div>
    </div>

    <form action="combat.php" method="POST" id="pokemon-form" class="mx-auto">
      <input type="hidden" name="pokemon1" id="pokemon1" value="" />
      <input type="hidden" name="pokemon2" id="pokemon2" value="" />
      <div class="flex justify-between p-2">
        <div id="types-container"
          class="hidden md:flex lg:pl-28 flex-col md:w-full md:max-w-[15rem] border-r-[1px] pt-10 gap-8 border-slate-100 gap-4 mb-20">
        </div>

        <div class="w-full pt-10 pl-8">
          <div class="flex items-center gap-2 mb-20">
            <img src="./public/assets/icons/icon-pokeball.svg" alt="" />
            <p class="text-xl font-bold">
              <span id="number-pokemons"></span> Pokemons
            </p>
          </div>
          <div class="result-search grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
        </div>
      </div>

      <button type="submit" id="submit-selection"
        class="fixed flex z-[1000] gap-2 items-center bottom-4 right-4 text-white rounded-full opacity-0 pointer-events-none transition-all">
        <img class="w-44 animate-bounce" src="./public/assets/img/pokeball-red.png" alt="" />
      </button>
    </form>
  </main>

  <script src="./script.js"></script>
</body>

</html>