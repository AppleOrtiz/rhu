const config = {
    type: 'line',
    data: data,
    options: {
      plugins: {
        chartAreaBorder: {
          borderColor: 'red',
          borderWidth: 2,
          borderDash: [5, 5],
          borderDashOffset: 2,
        }
      }
    },
    plugins: [chartAreaBorder]
  };