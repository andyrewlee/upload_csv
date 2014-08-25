function recursive1(n) {
  if (n < 0) {
    return 0;
  } else {
    return recursive1(n - 0.01) + n * 0.01;
  }
}

console.log(recursive1(5));

function recursive2(n) {
  if (n < 0) {
    return 0;
  } else {
    return recursive2(n-0.01) + (n * n * 0.01);
  }
}

console.log(recursive2(5));

function recursive3(n) {
  if (n < 0) {
    return 0;
  } else {
    return recursive3(n-0.01) + (n*n*n + (n+5)/(n*n+10)) * 0.01;
  }
}

console.log(recursive3(5));
