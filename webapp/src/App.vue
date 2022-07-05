<template>
  <router-view />
</template>

<style lang="scss">
:root {
  --dashboard-main: #f8bf06;
  --dashboard-warning: #fcbb64;
  --dashboard-success: #62fc9f;
  --dashboard-info: #84e9f4;
  --dashboard-color: #67041c;
  --dashboard-color-light: #7c1413;
  --dashboard-secondary: #e3e3e5;
  --primary-font: 'Mulish',
    sans-serif;
}


* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: var(--primary-font);
}

*::-webkit-scrollbar {
  width: .5vw;
}

*::-webkit-scrollbar-track {
  background: var(--dashboard-secondary);

}

*::-webkit-scrollbar-thumb {
  background: var(--dashboard-color);
}

body {
  max-width: 100vw;
  overflow-x: hidden;
}
</style>
