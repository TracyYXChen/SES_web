# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -13.09, 4.12, 17.05, -37.27, -5.84, -15.15, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -22.88, 18.44, -6.22, -26.97, -19.64, 8.63, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -6.05, -7.51, -10.84, -41.29, 5.08, 11.74, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_7')
