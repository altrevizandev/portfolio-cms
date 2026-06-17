const setPreviewImage = (e, img) => {
  console.log(e);
  
  const files = e.target.files;

  if (files.length > 0) {
    const file = files[0];

    const objectURL = URL.createObjectURL(file);

    img.src = objectURL;

    img.onload = function () {
      URL.revokeObjectURL(objectURL);
    };
  }
}

const toggleVisibilitty = (e) => {
  let oldClass = e?.getAttribute('class');

  if (oldClass) {
    if (oldClass.includes('visually-hidden')) {
      let classFormatted = oldClass.split('visually-hidden')[0];

      e.setAttribute('class', `${classFormatted}`);
    } else {
      e.setAttribute('class', `${oldClass} visually-hidden`);
    }
  } else {
    e?.setAttribute('class', 'visually-hidden');
  }
}

const toggleJobDateAreasVisibilitty = (e, div) => {
  toggleChangeImage(e, div);
}

const toggleChangeImage = (e, imgArea) => {
  if (e?.checked) {
    toggleVisibilitty(imgArea);
  } else {
    toggleVisibilitty(imgArea);
  }
}

const cancelChangeOfImages = (
  img,
  input,
  check,
  oldImage,
  imgArea,
  cancelBtn
) => {
  let oldBtnClass = cancelBtn.getAttribute('class');

  input.value = '';
  img.src = oldImage;
  check.checked = false;
  imgArea.setAttribute('class', 'visually-hidden');
  cancelBtn.setAttribute('class', `${oldBtnClass} visually-hidden`);
}

//Seção 1

//Criação

//Preview da imagem
let soCreateImgInput = document.getElementById("so-create-image-input");
let soCreateImg = document.getElementById("so-create-image-preview");

soCreateImgInput.addEventListener('change', (e) => {
  setPreviewImage(e, soCreateImg);
});

//Edição

//Quer mudar a imagem action
let soChangeImgCheckInput = document.getElementById("so-change-img-check-input");
let soChangeImgArea = document.getElementById("so-change-img-area");
let soChangeCancelChangeImageBtn = document.getElementById("so-change-cancel-change-image-btn");
let soChangeOldImage = document.getElementById("so-change-old-image")?.value ?? "";

toggleChangeImage(soChangeImgCheckInput,
  soChangeImgArea
);

toggleChangeImage(soChangeImgCheckInput,
  soChangeCancelChangeImageBtn
);

soChangeImgCheckInput?.addEventListener('change', (e) => {
  toggleChangeImage(e, soChangeImgArea);
  toggleChangeImage(e, soChangeCancelChangeImageBtn);
});

//Preview da imagem
let soChangeImgInput = document.getElementById("so-change-image-input");
let soChangeImg = document.getElementById("so-change-image-preview");

soChangeImgInput?.addEventListener('change', (e) => {
  setPreviewImage(e, soChangeImg);
});

//Cancelar troca da imagem
soChangeCancelChangeImageBtn?.addEventListener('click', (e) => {
  cancelChangeOfImages(
    soChangeImg,
    soChangeImgInput,
    soChangeImgCheckInput,
    soChangeOldImage,
    soChangeImgArea,
    soChangeCancelChangeImageBtn
  );
});

//Seção 2

//Criação

//Seu emprego atual
const stCreateActualJobCheckInput = document.getElementById('st-create-actual-job-check-input');
const stCreateSinceDateAreaDiv = document.getElementById('st-create-since-date-area');
const stCreateStartEndDateAreaDiv = document.getElementById('st-create-start-end-dates-area');
const stCreateImageInput = document.getElementById('st-create-image-input');
const stCreateImagePreviewImg = document.getElementById('st-create-image-preview');

toggleVisibilitty(stCreateSinceDateAreaDiv);

stCreateActualJobCheckInput.addEventListener('change', (e) => {
  toggleJobDateAreasVisibilitty(stCreateActualJobCheckInput, stCreateSinceDateAreaDiv);
  toggleJobDateAreasVisibilitty(stCreateActualJobCheckInput, stCreateStartEndDateAreaDiv);
});

stCreateImageInput.addEventListener('change', (e) => {
  setPreviewImage(e, stCreateImagePreviewImg);
});

//Edição

//Seu emprego atual
let checkboxInputs = document.querySelectorAll('.actual-job-checkbox');
let sinceAreaDivs = document.querySelectorAll('.st-since-area');
let sinceDateInputs = document.querySelectorAll('.st-since-date');
let startEndDateDivs = document.querySelectorAll('.st-start-end-dates-area');

checkboxInputs.forEach((input) => {
  if (input.checked) {
    let inputExpId = input.getAttribute('data-experience-id');

    sinceAreaDivs.forEach((sinceAreaDiv) => {
      let divExpId = sinceAreaDiv.getAttribute('data-experience-id');

      if (inputExpId == divExpId) {
        sinceAreaDivs.forEach((otherSinceAreaDiv) => {
          if (otherSinceAreaDiv != sinceAreaDiv) {
            otherSinceAreaDiv.style.display = "none";
          }
        });
      }
    });

    startEndDateDivs.forEach((startEndDateDiv) => {
      let startEndDateExpId = startEndDateDiv.getAttribute('data-experience-id');

      if (inputExpId == startEndDateExpId) {
        startEndDateDivs.forEach((otherStartEndDateDiv) => {
          if (otherStartEndDateDiv == startEndDateDiv) {
            otherStartEndDateDiv.style.display = "none";
          }
        });
      }
    });
  }

  input.addEventListener('change', (e) => {
    if (input.checked) {
      checkboxInputs.forEach((otherInput) => {
        if (otherInput != input) {
          otherInput.checked = false;
        }
      });

      sinceAreaDivs.forEach((sinceAreaDiv) => {
        let inputExpId = input.getAttribute('data-experience-id');
        let divExpId = sinceAreaDiv.getAttribute('data-experience-id');

        if (inputExpId == divExpId) {
          sinceAreaDivs.forEach((otherSinceAreaDiv) => {
            if (otherSinceAreaDiv != sinceAreaDiv) {
              otherSinceAreaDiv.style.display = "none";
            }
          });
        }
      });

      sinceAreaDivs.forEach((sinceAreaDiv) => {
        let inputExpId = input.getAttribute('data-experience-id');
        let divExpId = sinceAreaDiv.getAttribute('data-experience-id');

        if (inputExpId == divExpId) {
          sinceAreaDivs.forEach((otherSinceAreaDiv) => {
            if (otherSinceAreaDiv == sinceAreaDiv) {
              otherSinceAreaDiv.style.display = "block";
            }
          });
        }
      });

      startEndDateDivs.forEach((startEndDateDiv) => {
        let inputExpId = input.getAttribute('data-experience-id');
        let startEndDateExpId = startEndDateDiv.getAttribute('data-experience-id');

        if (inputExpId == startEndDateExpId) {
          startEndDateDivs.forEach((otherStartEndDateDiv) => {
            if (otherStartEndDateDiv == startEndDateDiv) {
              otherStartEndDateDiv.style.display = "none";
            }
          });
        }
      });

      startEndDateDivs.forEach((startEndDateDiv) => {
        let inputExpId = input.getAttribute('data-experience-id');
        let startEndDateExpId = startEndDateDiv.getAttribute('data-experience-id');

        if (inputExpId == startEndDateExpId) {
          startEndDateDivs.forEach((otherStartEndDateDiv) => {
            if (otherStartEndDateDiv != startEndDateDiv) {
              otherStartEndDateDiv.style.display = "block";
            }
          });
        }
      });
    }

    if (!input.checked) {
      checkboxInputs.forEach((otherInput) => {
        if (otherInput == input) {
          otherInput.checked = true;
        }
      });
    }
  });
});

//Preview da imagem
let stChangeImg = document.getElementById("st-change-image-preview");
let stChangeImgInput = document.getElementById("st-change-image-input");
let stChangeImgCheckInput = document.getElementById("st-change-img-check-input");
let stChangeImgArea = document.getElementById("st-change-img-area");
let stChangeOldImage = document.getElementById("st-change-old-image")?.value ?? "";
let stChangeImagePreviewImg = document.getElementById("st-change-image-preview");
let stChangeCancelChangeImageBtn = document.getElementById("st-change-cancel-change-image-btn");

toggleChangeImage(stChangeImgCheckInput,
  stChangeImgArea
);

toggleChangeImage(stChangeImgCheckInput,
  stChangeCancelChangeImageBtn
);

stChangeImgCheckInput?.addEventListener('change', (e) => {
  toggleChangeImage(e, stChangeImgArea);
  toggleChangeImage(e, stChangeCancelChangeImageBtn);
});

stChangeImgInput?.addEventListener('change', (e) => {
  setPreviewImage(e, stChangeImg);
});

//Cancelar troca da imagem
stChangeCancelChangeImageBtn?.addEventListener('click', (e) => {
  cancelChangeOfImages(
    stChangeImg,
    stChangeImgInput,
    stChangeImgCheckInput,
    stChangeOldImage,
    stChangeImgArea,
    stChangeCancelChangeImageBtn
  );
});

// Seção 3 - Linha 582

// Criação
let s3createCheckStillStudyingInput = document.getElementById("s3-create-check-still-studying");
let s3createSinceAreaDiv = document.getElementById("s3-create-since-area");
let s3createDatesAreaDiv = document.getElementById("s3-create-dates-area");

toggleVisibilitty(s3createSinceAreaDiv);

s3createCheckStillStudyingInput?.addEventListener('change', (checkbox) => {
  if (s3createCheckStillStudyingInput.checked) {
    toggleVisibilitty(s3createSinceAreaDiv);
    toggleVisibilitty(s3createDatesAreaDiv);
  } else {
    toggleVisibilitty(s3createSinceAreaDiv);
    toggleVisibilitty(s3createDatesAreaDiv);
  }
});

//Ainda cursando chackbox
let s3CheckboxInputs = document.querySelectorAll('.s3-still-studying-check');
let s3SinceAreaDivs = document.querySelectorAll('.s3-change-since-area');
let s3SinceDateInputs = document.querySelectorAll('.s3-change-since-input');
let s3StartEndDateDivs = document.querySelectorAll('.s3-change-start-end-date-div');

s3CheckboxInputs.forEach((input) => {
  if (input.checked) {
    let inputExpId = input.getAttribute('data-formation-id');

    s3SinceAreaDivs.forEach((sinceAreaDiv) => {
      let divExpId = sinceAreaDiv.getAttribute('data-formation-id');

      if (inputExpId == divExpId) {
        s3SinceAreaDivs.forEach((otherSinceAreaDiv) => {
          if (otherSinceAreaDiv != sinceAreaDiv) {
            otherSinceAreaDiv.style.display = "none";
          }
        });
      }
    });

    s3StartEndDateDivs.forEach((startEndDateDiv) => {
      let startEndDateExpId = startEndDateDiv.getAttribute('data-formation-id');

      if (inputExpId == startEndDateExpId) {
        s3StartEndDateDivs.forEach((otherStartEndDateDiv) => {
          if (otherStartEndDateDiv == startEndDateDiv) {
            otherStartEndDateDiv.style.display = "none";
          }
        });
      }
    });
  }

  input.addEventListener('change', (e) => {
    if (input.checked) {
      s3CheckboxInputs.forEach((otherInput) => {
        if (otherInput.checked) {
          s3StartEndDateDivs.forEach((startEndDateDiv) => {
            let inputExpId = otherInput.getAttribute('data-formation-id');
            let startEndDateExpId = startEndDateDiv.getAttribute('data-formation-id');

            if (inputExpId == startEndDateExpId) {
              startEndDateDiv.style.display = 'none';
            }
          });

          s3SinceAreaDivs.forEach((sinceAreaDiv) => {
            let inputExpId = otherInput.getAttribute('data-formation-id');
            let startEndDateExpId = sinceAreaDiv.getAttribute('data-formation-id');

            if (inputExpId == startEndDateExpId) {
              sinceAreaDiv.style.display = 'block';
            }
          });
        }
      });
    }

    if (!input.checked) {
      s3CheckboxInputs.forEach((otherInput) => {
        if (!otherInput.checked) {
          s3StartEndDateDivs.forEach((startEndDateDiv) => {
            let inputExpId = otherInput.getAttribute('data-formation-id');
            let startEndDateExpId = startEndDateDiv.getAttribute('data-formation-id');

            if (inputExpId == startEndDateExpId) {
              startEndDateDiv.style.display = 'block';
            }
          });

          s3SinceAreaDivs.forEach((sinceAreaDiv) => {
            let inputExpId = otherInput.getAttribute('data-formation-id');
            let startEndDateExpId = sinceAreaDiv.getAttribute('data-formation-id');

            if (inputExpId == startEndDateExpId) {
              sinceAreaDiv.style.display = 'none';
            }
          });
        }
      });
    }

  });
});
